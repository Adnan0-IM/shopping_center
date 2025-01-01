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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Dashboard</title>
    <link rel="stylesheet" href="style.css">
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
        <h1><a href="homepage.php">FUD Shopping Center</a></h1>
        <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
        <ul id="links">
          <li><a href="homepage.php">Home</a></li>
          <li><a href="logout.php" >Sign Out</a></li>
        </ul>
      </nav>
    </header>
    <section>
    <div class="con">
        <div class="searchbar">
            <input type="search" id="search_bar" placeholder="Search Product">
            <a href="#search" class="btn nnn">Search<a/>
        </div>
    </div>
    </section>
<h2">Available Products</h2>

<section id="gen-dashboard">
    <div class="dashboard-container">
        <?php while ($item = $result->fetch_assoc()): ?>
            <div class="card items">
                <div class="body">
                    <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['item_name']); ?>">
                    <div class="details">
                        <h5 class="title"><?php echo htmlspecialchars($item['item_name']); ?></h5>
                        <p class="price">Price: ₦<?php echo number_format($item['price'], 2); ?></p>
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['item_id']); ?>">
                            <button type="submit" class="btn items-button">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</section>
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