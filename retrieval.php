<?php

// Create connection
require 'conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch items/products
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$items = array();

// Check if records found
if ($result->num_rows > 0) {
    // Fetch data into an associative array
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
} else {
    echo "0 results";
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($items);

// Close connection
$conn->close();
?>
