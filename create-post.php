<?php
include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

// $_POST
$postcontent = (isset($_POST['postcontent']) ? $_POST['postcontent'] : '');

// TODO THIS WILL BE DYANMIC DEPENDING ON THE CATEGORY
$categoryID = (isset($_POST['categoryID']) ?  $_POST['categoryID'] : "");

// TODO THIS WOULD COME FROM THE SESSION
$userID = (isset($_POST['userID']) ? $_POST['userID'] : '');

// POST PAERTN
$postParent = (isset($_POST['postParent']) ? $_POST['postParent'] : '');

// CREATE A CONTAINER FOR ANY ERRROS;
$errors = [];

// CHECK IF POST IS BLANK
if($postcontent=="" || !isset($postcontent)){

    $errors[] = "Your post cannot be blank";

}

// CHECK USERID ISNT BLANK
if($userID=="" || !isset($userID)){

    $errors[] = "There is no user associated with this post";

}

// CHECK IF CAT IS PRESENT
if($categoryID=="" || !isset($categoryID)){

    $errors[] = "There is no category associated with this post";

}



if(count($errors)>0){

    $response = array("status"=>"error",'errors'=>$errors);
    echo json_encode($response);

} else {
    
    
    // TODO: CHECK IF PARENT / CHILD POST
    if($postParent!=""){

        // DO SOMETHING HERE
        $prequery = "INSERT INTO posts (content,created_at,user_id,category_id, parent_post) values(?,NOW(),?,?,?)";
    
        $query = $conn->prepare($prequery);
        $query->bindParam(1, $postcontent);
        $query->bindParam(2, $userID);
        $query->bindParam(3, $categoryID);        
        $query->bindParam(4, $postParent);                

    } else {

        $prequery = "INSERT INTO posts (content,created_at,user_id,category_id) values(?,NOW(),?,?)";
        
        $query = $conn->prepare($prequery);
        $query->bindParam(1, $postcontent);
        $query->bindParam(2, $userID);
        $query->bindParam(3, $categoryID);

    }
    

    try {

        $query->execute();

        $response = array('status'=>'success','message'=>'The post was successfully created');
        echo json_encode($response);

    } catch(PDOException $e){

        print_r($e);

        $response = array('status'=>'error','errors'=>array('There was an issue adding your post.'));
        echo json_encode($response);

    }


    

}




?>