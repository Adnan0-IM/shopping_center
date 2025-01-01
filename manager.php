<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="style.css" />
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
          <li><a href="logout.php" >Sign Out</a></li>
        </ul>
      </nav>
    </header>
    <div class="con">
    <a href="orders.php" class="btn btn-info mt-4">View Orders</a>
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