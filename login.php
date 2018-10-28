<?php
session_start();

include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

$username = (isset($_POST['username']) ? $_POST['username'] : '');
$password = (isset($_POST['password']) ? sha1($_POST['password']) : '');


$errors = [];

if($username==""){
    $errors[] = "The username cannot be blank";
}

if($password==""){
    $errors[] = "The password cannot be blank";
}


if(count($errors) > 0){
    
    $response = array('status'=>'error','errors'=>$errors);
    echo json_encode($response);

} else {

    // PREPARE THE QUERY
    $prequery = "SELECT id, username FROM users WHERE username = ? AND password = ?";

    $query = $conn->prepare($prequery);
    $query->bindParam(1, $username);
    $query->bindParam(2, $password);    
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if(count($results) == 1){
        
        // WRITE DATA TO SESSION
        $_SESSION['user']['username'] = $results[0]['username'];
        $_SESSION['user']['id'] = $results[0]['id'];        

        $response = array('status'=>'success','message'=>'You have logged in');
        echo json_encode($response);


    } else {
        $response = array('status'=>'error','message'=>'Your username or password were incorrect');
        echo json_encode($response);
    }
    
    // OUTPUT THE JSON

}


?>