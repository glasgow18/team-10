<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forum</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  </head>
<body>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Children With Cancer UK Forums</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.html">Home</a></li>
      
      </li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../login.html"><span class="glyphicon glyphicon-user"></span> Register</a></li>
      <li><a href="../login.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>





<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav">

	<br><br><br><br>
      <h4>Welcome to the Children with Cancer forums</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Forum Home</a></li>
        <li><a href="#section2">Popular Questions</a></li>
        <li><a href="#section3">Hospital Questions</a></li>
        <li><a href="post.html">Friends & Family Questions</a></li>
      </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Forums...">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div><br><br><br><br>

    <div class="col-sm-9">

<?php
include('../includes/db-connect.php');

// RETURN JSON

$categoryID = 43;

$errors = [];

if($categoryID==""){
    $errors[] = "The posts could not be retrieved. Make sure you have selected a category.";
}

if(count($errors) > 0){
    $response = array('status'=>'error','errors'=>$errors);
    echo json_encode($response);
} else {

    // PREPARE THE QUERY
    $prequery = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id  WHERE category_id = ?";
    $query = $conn->prepare($prequery);
    $query->bindParam(1, $categoryID);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($results as $post){

      ?>
<!-- <h4><small>Page Name</small></h4> -->
      <hr>
       <!-- <h2><a href="post.html">I'm worried about going to the hospital...</a></h2> -->
      <h5><span class="glyphicon glyphicon-time"></span> Post by <a href="../profile_page.html"><?php echo $post['username'];?> </a>, <?php echo date('dS F Y H:i',strtotime($post['created_at']));?></h5>
      <h5><span class="label label-danger">Hospital</span> <span class="label label-primary">Treatment</span></h5><br>
      <p><?php echo $post['content'];?></p>
      <p><a href="#add-post"><span class="glyphicon glyphicon-comment"></span> Comment</a> <a href="#"><span class="glyphicon glyphicon-heart"></span> Like</a></p>
      <br>
      <?php

    }

    // OUTPUT THE JSON
    // echo json_encode($results);

}
?>


      <!-- <h4><small>RECENT POSTS</small></h4>
      <hr>
      <h2><a href="post.html">I'm worried about going to the hospital...</a></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by <a href="../profile_page.html"> smileytiger </a>, Oct 28, 2018.</h5>
      <h5><span class="label label-danger">Hospital</span> <span class="label label-primary">Treatment</span></h5><br>
      <p>Im worried about going to the hospital because... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><br>
      
      
      <hr>
      <h2><a href="post.html">How do I tell my friends I have cancer?</a></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by batman, Oct 28, 2018.</h5>
      <h5><span class="label label-success">Family</span></h5><br>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr>
	  
	  
	  <h2><a href="post.html">What happens during treatment?</a></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by t-rex, Oct 28, 2018.</h5>
      <h5><span class="label label-danger">Hospital</span> <span class="label label-primary">Treatment</span></h5><br>
      <p>Im worried about going to the hospital because... Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <br><br>
	  
	  
      <hr>
      <h2><a href="post.html">How can I find someone to talk to about my condition?</a></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Post by Steven, Oct 27, 2018.</h5>
      <h5><span class="label label-success">Family</span></h5><br>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      <hr> -->
      
     
              <h3>Add Comment</h3>
              <?php

              if(isset($_POST['submit'])){

                // GET THE DETAILS AND ADD THE POST
                $postcontent = (isset($_POST['content']) ? $_POST['content']: '');
                $errors = [];
                if($postcontent==''){
                  $errors[] = "The content cannot be blank";
                }

                if(count($errors) > 0){

                  echo '<div class="alert alert-danger" role="alert">';
                  echo "Your post cannot be blank";
                  echo '</div>';

                  // echo "<div>";
                  // echo "The post cannot be blank";
                  // echo "</div>"

                } else {

                  include('../includes/db-connect.php');
                  $prequery = "INSERT INTO posts (content,created_at,user_id,category_id) values(?,NOW(),?,?)";

                  $userID = 1;
                  $categoryID = 43;
        
                  $query = $conn->prepare($prequery);
                  $query->bindParam(1, $postcontent);
                  $query->bindParam(2, $userID);
                  $query->bindParam(3, $categoryID);
                  $query->execute();

                  header("Location: #add-post");

                  ob_end_flush();

                }

              }

              ?>
              <form action="#add-post" id="add-post" method="post">
              <div class="form-group">
              <!-- <label for="post">Post</label> -->
              <textarea class="form-control" id="post" rows="3" name="content" name="post"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="submit">Post</button>
            </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>© 2018 Children with Cancer UK. 51 Great Ormond Street, London, WC1N 3JQ. Registered Charity Number: 298405</p>
</footer>
<!-- <script src="../js/create-post.js"></script> -->
</body>
</html>
