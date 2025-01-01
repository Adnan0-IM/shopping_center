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

// Fetch user information
$user_id = $_SESSION['user_id'];
$user_query = "SELECT username FROM users WHERE user_id='$user_id'";
$user_result = $conn->query($user_query);
$user = $user_result->fetch_assoc();

// Check if user exists
if (!$user) {
    echo "User not found!";
    exit();
}

// Fetch items from the database
$query = "SELECT * FROM items";
$result = $conn->query($query);

// Fetch cart items for the logged-in user
$cart_query = "SELECT c.quantity, i.item_name, i.price, i.image, c.cart_id FROM cart c 
               JOIN items i ON c.item_id = i.item_id 
               WHERE c.user_id = '$user_id'";
$cart_result = $conn->query($cart_query);
?>

<!-- blabla -->


<?php

$user_id = $_SESSION['user_id'];

// Fetch items from the cart
// $query = "SELECT cart.*, items.item_name, items.price, items.image FROM cart 
//           JOIN items ON cart.item_id = items.item_id 
//           WHERE cart.user_id='$user_id'";
// $result = $conn->query($query);
?>
<!-- blabla -->
<?php
// $total = 0;
// while ($row = $result->fetch_assoc()) {
//     $item_total = $row['price'] * $row['quantity'];
//     $total += $item_total;
// }
// ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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

.center h2 {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.disabled {
            pointer-events: none;
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <header>
      <nav>
        <h1><a href="index.php">FUD Shopping Center</a></h1>
        <span class="hamburger">&#9776;</span>
        <ul  id="links">
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php" >Login</a></li>
          <li><a href="logout.php" >Sign Out</a></li>
        </ul>
      </nav>
    </header>
    <div class="center">

        <h2 >Your Cart</h2>
    </div>
    <div class="dashboard-container">
         <div class="con">
            <?php if ($cart_result->num_rows > 0): ?>
                <?php while ($cart_item = $cart_result->fetch_assoc()): ?>
                    <div class="card items">
                        <div class="body">
                            <img src="<?php echo htmlspecialchars($cart_item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($cart_item['item_name']); ?>">
                            <div class="datails">
                                <h4 class="title"><?php echo htmlspecialchars($cart_item['item_name']); ?></h4>
                                <h5 class="price">Price: ₦<?php echo number_format($cart_item['price'], 2); ?></h5>
                                <p class="quantity">Quantity: <?php echo htmlspecialchars($cart_item['quantity']); ?></p>
                                <h4 class="tprice">Total: ₦<?php echo number_format($cart_item['price'] * $cart_item['quantity'], 2); ?></h4>
                                <div style="display:flex; justify-content:center;">
                                <form style="width: 50%; box-shadow: none; margin:0; padding: 0 20px;" action="checkout.php" method="POST">
                                    <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($cart_item['cart_id']); ?>">
                                    <button type="submit" class="btn btn-green">Pay</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php endwhile; ?>
                    <a href="checkout.php#" class="btn btn-success disabled">Proceed to Checkout</a><br>
                    <p>Shop More</p>
                    <h3>Avialable Products</h3>
                    <div class="dashboard-container">
                            <?php while ($item = $result->fetch_assoc()): ?>
                                <div class="card items">
                                    <div class="body">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['item_name']); ?>">
                                        <div class="details">
                                            <h4 class="title"><?php echo htmlspecialchars($item['item_name']); ?></h4>
                                            <h4 class="price">Price: ₦<?php echo number_format($item['price'], 2); ?></h4>
                                            <div style="display:flex; justify-content:center;">
                                            <form style="width: 50%; box-shadow: none; margin:0; padding: 0 20px;" action="add_to_cart-none.php" method="POST">
                                                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                                <button type="submit" class="btn items-button">Add to Cart</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
            <?php else: ?>
                        <p>Your cart is empty, Add products to cart.</p>
                        <div class="dashboard-container">
                            <?php while ($item = $result->fetch_assoc()): ?>
                                <div class="card items">
                                    <div class="body">
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['item_name']); ?>">
                                        <div class="details">
                                            <h4 class="title"><?php echo htmlspecialchars($item['item_name']); ?></h4>
                                            <h4 class="price">Price: ₦<?php echo number_format($item['price'], 2); ?></h4>
                                            <div style="display:flex; justify-content:center;">
                                            <form style="width: 50%; box-shadow: none; margin:0; padding: 0 20px;" action="add_to_cart-none.php" method="POST">
                                                <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                                <button type="submit" class="btn items-button">Add to Cart</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
            <?php endif; ?>
        </div>
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
