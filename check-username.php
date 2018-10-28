<?php
include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

// USERNAME
$username = (isset($_POST['username']) ? $_POST['username'] : '');


// CREATE A CONTAINER FOR ANY ERRROS;
$errors = [];

// CHECK IF POST IS BLANK
if($username!=""){

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

if(count($errors) > 0){

    $response = array('status'=>'error','errors'=>$errors);
    echo json_encode($response);

} else {
    $response = array('status'=>'success','message'=>'User name is available');
    echo json_encode($response);
}



?>