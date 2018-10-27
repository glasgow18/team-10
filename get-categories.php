<?php

include('includes/db-connect.php');

// RETURN JSON
header('Content-type: application/json');

// PREPARE THE QUERY
$prequery = "SELECT * FROM categories";
$query = $conn->prepare($prequery);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// OUTPUT THE JSON
echo json_encode($results);

?>