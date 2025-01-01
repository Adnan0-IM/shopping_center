<?php
require 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SalesPerson Page</title>
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
          .search_form {
            flex-direction: column;
          }
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
          <li><a href="logout.php">Sign out</a></li>
        </ul>
      </nav>
    </header>
    <div id="function">
        <nav id="functions" style="background:#555;color:#ccc;">
            <ul>
                <li><a href="#sold_items" class="btn">View Sold Items</a></li>
                <li><a href="#reports" class="btn">View Reports<a/></li>
            </ul>
        </nav>
</div>


    <div class="con">
    
        <form action="salesperson.php" method="GET" class="search_form">
              <input type="text" name="search" placeholder="Enter product name" id="search_bar" required>
              <button type="submit" class="btn nnn">Search</button>
        </form>
   
</div>

    <?php
    // Check if the search query is set
    if (isset($_GET['search'])) {

        $search = $conn->real_escape_string($_GET['search']); // Sanitize user input

        // Search query: Adjust 'items' table and 'name' column based on your database schema
        $query = "SELECT * FROM items WHERE item_name LIKE '%$search%'";

        // Execute the query
        $result = $conn->query($query);

       ?> <section class="gen-dashboard" id="gen-dashboard" >
        <div class="dashboard-container">

        </div> 
     <?php   // Check if any results were found
        if ($result->num_rows > 0) {
            echo "<div class='con'><h2>Search Results:</h2></div>";  ?>
            <div class="dashboard-container">
    <?php   while ($row = $result->fetch_assoc()) {?>
            <div class="card items">
                <div class="body">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['item_name']; ?>">
                    <div class="details">
                        <h5 class="title"><?php echo $row['item_name']; ?></h5>
                        <p class="price">Price: ₦<?php echo number_format($row['price'], 2); ?></p>
                        <a href="add_to_cart#.php?item_id=<?php echo $row['item_id']; ?>" class="btn item-btn">Add to Cart</a>
                    </div>
                </div>
            </div>
            </div>
    </div>
    </section>
           <?php }?>
           
     <?php   } else {
           
            echo "<div class='con'><h4>No products found matching '$search'.<br>Explore the available products</h4></div>";
           
        }

        // Close the database connection
        $conn->close();
    }
    ?>
         
         <section id="gen-dashboard">
           <div class="con">
           <h2>Available Products</h2>
           </div> 
        <div class="dashboard-container">
        <div id="shop" class="dashboard-container" ></div>
        </div>
      </section>
      <footer>
        <p>&copy; 2024 FUD Shopping Center. All rights reserved.</p>
      </footer>
      
<script>
let generateShop = () => {
    // Fetch the product data from PHP
    fetch('retrieval.php')  // or provide the correct PHP URL
    .then(response => response.json())
    .then(shopItemsData => {
        document.getElementById('shop').innerHTML = shopItemsData
            .map((x) => {
                let { id, item_name, description, image, price } = x;
                return `
                <div id=product-id-${id} class="card items">
                  <img width="300" src=${image} alt="maybe is .png">
                  <div class="details">
                    <h3 style="margin-bottom:0px;">${item_name}</h3>
                    <div class="">
                      <h2>$ ${price} </h2>
                    </div>
                  </div>
                  <a href="#add_to_cart" class="btn item-btn">Add to Cart</a>
                </div>
                `;
            })
            .join("");
    })
    .catch(error => console.error('Error:', error));
};

// Call the function to display products
generateShop();
</script>
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
  