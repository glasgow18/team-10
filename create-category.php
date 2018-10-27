<?php

include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

// $_POST['categoryname']
$categoryname = $_POST['category_name'];

$errors = [];

// CHECK ISNT BLANK
if($categoryname=="" || !isset($categoryname)){

    $errors[] = "The category name cannot be blank.";

}

// IF THERE ARE ERRORS, RETURN THESE
if(count($errors)>0){

    $response = array("status"=>"error",'errors'=>$errors);
    echo json_encode($response);

} else {

    // PREPARE THE QUERY
    $prequery = "INSERT INTO categories (name,created_at) values(?,NOW())";
    $query = $conn->prepare($prequery);
    $query->bindParam(1, $categoryname);
    
    // CHECK THE QUERY EXECUTES - CATCH IF THERE IS AN INTEGRITY CONSTAINT 
    try {
        
        if($query->execute()){
            $response = array('status'=>'success','message'=>'The category was successfully created');
        echo json_encode($response);
        }
    
    
    } catch(PDOException $e) {
       
            $response = array('status'=>'error','errors'=> array('This category already exists'));
            echo json_encode($response);
    
    }

}




?>