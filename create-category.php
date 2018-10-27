<?php
include('includes/db-connect.php');

// CATEGORY = name

// TODO - GET FROM THE FROM
// $_POST['categoryname']
$categoryname = "Chemo Therapy";

// TODO - DO SOME CHECKS

// MKAE SURE ISNT BLANK

// MAKE SURE DOESNT EXIST ALREADY


$prequery = "INSERT INTO categories (name,created_at) values(?,NOW())";

$query = $conn->prepare($prequery);
$query->bindParam(1, $categoryname);
$query->execute();


?>