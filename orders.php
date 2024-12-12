<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'shopping_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all orders for the logged-in user
$order_query = "SELECT o.*, i.item_name, i.price FROM orders o 
                JOIN items i ON o.item_id = i.item_id 
                WHERE o.user_id = '$user_id'";
$order_result = $conn->query($order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header>
      <nav>
        <h1><a href="index.php">FUD Shopping Center</a></h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php" >Login</a></li>
          <li><a href="signup.php" >Sign Up</a></li>
        </ul>
      </nav>
    </header>
    <div class="container mt-5">
        <h1>Your Orders</h1>
        <a href="user_dashboard.php" class="btn btn-secondary mb-4">Back to Dashboard</a>

        <?php if ($order_result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Shipping Address</th>
                            <th>Ordered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $order_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['id']); ?></td>
                                <td><?php echo htmlspecialchars($order['item_name']); ?></td>
                                <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                <td>₦<?php echo number_format($order['total_price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                                <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </div>

    <footer class="foot">
    <p>&copy; 2024 FUD Shopping Center. All rights reserved.</p>
</footer>
<script src="register.js"></script>
</body>
</html>

<?php
$conn->close();
?>
