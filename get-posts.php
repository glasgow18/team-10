<?php

include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

$categoryID = (isset($_POST['categoryID']) ? $_POST['categoryID'] : '');

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
    
    // OUTPUT THE JSON
    echo json_encode($results);

}


?>