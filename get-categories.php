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
print_r(json_encode($results));

?>