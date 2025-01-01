<?php
session_start();
require 'conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$item_id = $_POST['item_id'];

// Check if item already exists in the cart
$check_query = "SELECT * FROM cart WHERE user_id = '$user_id' AND item_id = '$item_id'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // If it exists, update the quantity
    $cart_item = $check_result->fetch_assoc();
    $new_quantity = $cart_item['quantity'] + 1;
    $update_query = "UPDATE cart SET quantity = '$new_quantity' WHERE cart_id = '{$cart_item['cart_id']}'";
    $conn->query($update_query);
} else {
    // If it doesn't exist, insert a new cart item
    $insert_query = "INSERT INTO cart (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', 1)";
    $conn->query($insert_query);
}

header('Location: products.php'); // Redirect to the user dashboard or another page
$conn->close();
?>
