<?php
// Include database connection
session_start();
require 'conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if the item_id is set in the URL
if (isset($_GET['item_id'])) {
    $item_id = intval($_GET['item_id']); // Get the item_id and convert it to an integer

    // Prepare the SQL DELETE statement
    $query = "DELETE FROM items WHERE item_id = ?";
    
    // Prepare and execute the statement
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $item_id); // Bind the item_id as an integer
        if ($stmt->execute()) {
            // Redirect to the page where the items are displayed
            header("Location: admin_dashboard.php?message=ItemDeleted");
            exit(); // Ensure the script stops after redirection
        } else {
            echo "Error deleting item: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid request. No item_id provided.";
}

// Close the database connection
$conn->close();
?>