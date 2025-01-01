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
    <style>

.hamburger {
    display: none;
    
}    
        @media (max-width: 768px) {
    #function {
        display: none;
    }
    header nav h1 {
        font-size: 1rem;
        
    }
}

@media (max-width: 469px) {
    #links {
        display: none;
        flex-direction: column;
        background-color: #333;
        position: absolute;
        top: 50px;
        width: 100%;
        left: 0;
        padding: 0;
        margin: 0;
        border-top: 2px solid #444;
        border-bottom: 2px solid #444;
    
}

    #links li {
        list-style: none;
        border-bottom: 1px solid #444;
    }
    #links li a {
        display: block;
        padding: 10px;
        color: white;
        text-decoration: none;
    }
    #links li a:hover {
        background-color: #555;
    }
    .hamburger {
        display: block;
        cursor: pointer;
        font-size: 25px;
        margin-bottom: 0;
        padding-bottom:0;
        padding-right: 20px; 
    }
    
}

@media (min-width: 469px) {
    #links {
        display: block;
        
    }
}


</style>
</head>
<body>
    <header>
      <nav>
        <h1><a href="index.php">FUD Shopping Center</a></h1>
        <div class="hamburger">&#9776;</div>
        <ul id="links">
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
<script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            var links = document.getElementById('links');
            if (links.style.display === 'block') {
                links.style.display = 'none';
            } else {
                links.style.display = 'block';
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
