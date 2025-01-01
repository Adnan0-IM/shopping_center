<?php
session_start();
require 'conn.php';


// Fetch all items from the items table
$query = "SELECT * FROM items";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Sales Inventory System</title>
    <link href="style.css" rel="stylesheet">
    <style>
      .body {
        padding-bottom: 20px;
      }

      .price {
        margin-bottom: 10PX;
      }

      .non {
        margin: 0;
        padding-top: 10px;
      }


    </style>
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
    <!-- Navigation Bar -->
    <header>
      <nav>
        <h1><a href="index.php">FUD Shopping Center</a></h1>
        <span class="hamburger">&#9776;</span>
        <ul id="links">
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php" >Login</a></li>
          <li><a href="signup.php" >Sign Up</a></li>
        </ul>
      </nav>
    </header>

    <section id="home">
      <h2>Welcome to the FUD Shopping Center</h2>
      <h3>Your one-stop solution for inventory and order management.</h3>
      <a href="signup.php" class="btn" target="_blank">Sign Up</a>
      <a href="login.php" class="btn" target="_blank">Log In</a>
    </section>

    <!-- Products Section -->
    <div class="gen-dashboard" id="gen-dashboard" >
       <div class="con non">
       <h2>Available Products</h2>
       </div> 
        <div class="dashboard-container">
            <?php while($row = $result->fetch_assoc()) { ?>
            <div class="card items">
                <div class="body">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['item_name']; ?>">
                    <div class="details">
                        <h4 class="title" style="margin-bottom: 0;"><?php echo $row['item_name']; ?></h4>
                        <h4 class="price">Price: ₦<?php echo number_format($row['price'], 2); ?></h4>
                        <a href="add_to_cart.php?item_id=<?php echo $row['item_id']; ?>" class="btn item-btn">Add to Cart</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
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
