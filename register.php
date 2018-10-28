<?php
include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

// $_POST
// USERNAME
$username = (isset($_POST['username']) ? $_POST['username'] : '');

// EMAIL
$email = (isset($_POST['email']) ? $_POST['email'] : '');
// PASSWORD CONF

$password = (isset($_POST['password']) ? $_POST['password'] : '');

$passconf = (isset($_POST['passconf']) ? $_POST['passconf'] : '');

// CREATE A CONTAINER FOR ANY ERRROS;
$errors = [];

// CHECK IF POST IS BLANK
if($username==""){

    $errors[] = "Your must choose a username";

} else {

    // TODO: CHECK USERNAME DOESNT EXIST
    $prequery = "SELECT COUNT(*) AS count FROM users WHERE username=?";
        
        $query = $conn->prepare($prequery);
        $query->bindParam(1, $username);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if($results[0]['count']>0){
            $errors[] = "That username is already been taken";
        }


}

// CHECK EMAIL
if($email==""){

    $errors[] = "Please enter your email";

} else {

    // TODO: CHECK USERNAME DOESNT EXIST
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid email.";
    }

}

if($password=='' || $passconf==''){
    $errors[] = "You must enter a password";
} else {

    if($password!=$passconf){

        $errors[] = "Your passwords do not match";

    }

}



if(count($errors)>0){

    $response = array("status"=>"error",'errors'=>$errors);
    echo json_encode($response);

} else {
    
    
    // TODO: CHECK IF PARENT / CHILD POST

        $prequery = "INSERT INTO users (username, email, password, created_at) values(?, ?, ?, NOW())";
        
        $query = $conn->prepare($prequery);
        $query->bindParam(1, $username);
        $query->bindParam(2, $email);
        $query->bindParam(3, sha1($password));
    

    try {

        $query->execute();

        $response = array('status'=>'success','message'=>'Your account was registered');
        echo json_encode($response);

    } catch(PDOException $e){

        print_r($e);
        $response = array('status'=>'error','errors'=>array('There was an error registering your account.'));
        echo json_encode($response);

    }


    

}




?>