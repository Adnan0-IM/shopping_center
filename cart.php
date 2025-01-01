<?php
session_start();
require 'conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch items from the cart
$query = "SELECT cart.*, items.item_name, items.price, items.image FROM cart 
          JOIN items ON cart.item_id = items.item_id 
          WHERE cart.user_id='$user_id'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header>
      <nav>
        <h1><a href="index.php">FUD Shopping Center</a></h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="logout.php" >Sign Outt</a></li>
        </ul>
      </nav>
    </header>
    <div class="container mt-5">
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while ($row = $result->fetch_assoc()) {
                    $item_total = $row['price'] * $row['quantity'];
                    $total += $item_total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td>₦<?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td>₦<?php echo number_format($item_total, 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3>Total: ₦<?php echo number_format($total, 2); ?></h3>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
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
