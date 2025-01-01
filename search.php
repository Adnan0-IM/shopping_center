<?php
session_start();
require 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Search for a Product</h1>

    <form action="search.php" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Enter product name" class="search-input" required>
        <button type="submit" class="btn item_button">Search</button>
    </form>

    <?php
    // Check if the search query is set
    if (isset($_GET['search'])) {

        $search = $conn->real_escape_string($_GET['search']); // Sanitize user input

        // Search query: Adjust 'items' table and 'name' column based on your database schema
        $query = "SELECT * FROM items WHERE item_name LIKE '%$search%'";

        // Execute the query
        $result = $conn->query($query);

       ?> <div class="gen-dashboard" id="gen-dashboard" > 
     <?php   // Check if any results were found
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";  ?>
            <div class="dashboard-container">
    <?php   while ($row = $result->fetch_assoc()) {?>
            <div class="card items">
                <div class="body">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['item_name']; ?>">
                    <div class="details">
                        <h5 class="title"><?php echo $row['item_name']; ?></h5>
                        <p class="price">Price: ₦<?php echo number_format($row['price'], 2); ?></p>
                        <a href="add_to_cart.php?item_id=<?php echo $row['item_id']; ?>" class="btn item-btn">Add to Cart</a>
                    </div>
                </div>
            </div>
            </div>
            </div>
           <?php }?>
           
     <?php   } else {
            echo "<p>No products found matching '$search'.</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

</body>
</html>