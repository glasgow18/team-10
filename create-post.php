<?php
include('includes/db-connect.php');


// $_POST
$postcontent = "This is a new post from PHP here is a new onw";

// TODO THIS WILL BE DYANMIC DEPENDING ON THE CATEGORY
$category_id = 1;

// TODO THIS WOULD COME FROM THE SESSION
$user_id = 1;

// TODO - DO SOME CHECKS

// MAKE SURE ISNT BLANK

// CHECK IF IT'S A REPLY OR A MAIN POST



$prequery = "INSERT INTO posts (content,created_at,user_id,category_id) values(?,NOW(),?,?)";

$query = $conn->prepare($prequery);
$query->bindParam(1, $postcontent);
$query->bindParam(2, $user_id);
$query->bindParam(3, $category_id);
$query->execute();


?>