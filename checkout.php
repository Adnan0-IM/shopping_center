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
$cart_id = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0;

if ($cart_id > 0) {
    // Fetch cart item information
    $cart_query = $conn->prepare("SELECT c.quantity, i.price, c.item_id FROM cart c JOIN items i ON c.item_id = i.item_id WHERE c.cart_id=? AND c.user_id=?");
    $cart_query->bind_param("ii", $cart_id, $user_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();
    $cart_item = $cart_result->fetch_assoc();

    if ($cart_item) {
        $total_price = $cart_item['price'] * $cart_item['quantity'];
        $item_id = $cart_item['item_id'];

        // Placeholder for processing payment logic

        // Insert into orders table
        $order_query = $conn->prepare("INSERT INTO orders (user_id, item_id, quantity, total_price, shipping_address) VALUES (?, ?, ?, ?, 'Placeholder Address')");
        $order_query->bind_param("iiid", $user_id, $item_id, $cart_item['quantity'], $total_price);
        $order_query->execute();

        // Remove item from cart after successful checkout
        $delete_query = $conn->prepare("DELETE FROM cart WHERE cart_id=?");
        $delete_query->bind_param("i", $cart_id);
        $delete_query->execute();

        echo "Order placed successfully!";
    } else {
        echo "Cart item not found.";
    }
} else {
    echo "Invalid cart ID.";
}

$conn->close();
?>
