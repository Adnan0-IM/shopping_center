<?php
session_start();
require 'conn.php';

// Check if user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'IVM') {
    header('Location: login.php');
    exit;
}

// Handle item upload
if (isset($_POST['upload'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image or fake image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES['image']['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (jpeg, png, jpg)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 (failed validation)
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Upload image and insert item into the database
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $query = "INSERT INTO items (item_name, price, image) VALUES ('$item_name', '$price', '$target_file')";
            if ($conn->query($query) === TRUE) {
                echo "The file ". basename($image) ." has been uploaded and item added.";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            
            //add error checking code
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                echo "Error uploading file: " . $_FILES['image']['error'];
                // or
                error_log("Error uploading file: " . print_r($_FILES['image'], true));
            }
        }
    }
}


// Fetch items from the database
$query = "SELECT * FROM items";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Upload Item</title>
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
          <span class="hamburger">&#9776;</span>
        <ul id="links">
          <li><a href="index.php">Home</a></li>
          <li><a href="logout.php" >Sign Out</a></li>
        </ul>
       
      </nav>
    </header>
    <div id="function" >
        <nav id="functions" style="background:#555;color:#ccc;">
            <ul>
                <li><a href="#view_orders" class="btn">View Order Items</a></li>
                <li><a href="#add_user" class="btn">Add/Remove Users</a></li>
                <li> <a href="#reports" class="btn">View Reports</a></li>
                <li><a href="#returned_items" class="btn">View Returned Items</a></li>
                <li><a href="#sold_items" class="btn">View Sold Items</a></li>
                <li><a href="#item_price" class="btn">Add/Update Price</a></li>
            </ul>
       
        </nav>
    </div>

    <!-- Upload Form -->
     <div class="home">
        
       
     </div>
    <div class="container " id="add_item">
      <div class="con">
      <h2 >Upload New Products</h2>
      </div>
        <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
            <div >
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item_name" name="item_name" required>
            </div>
            <div >
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div >
                <label for="image" class="form-label">Item Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" name="upload" class="btn item-button">Upload Item</button>
        </form>
       <div class="con">
        <p>or</p>
       <button class="btn delete_btn" id="deleteButton"> Delete items</button>
       </div> 
    </div>

    <div id="delete_item" style="display:none;">
     <div class="con">
     <h2>Delete Unavailable Products</h2>
     </div>

     <div class="gen-dashboard" id="gen-dashboard" >
         <div class="dashboard-container">
             <?php while($row = $result->fetch_assoc()) { ?>
             <div class="card items">
                 <div class="body">
                     <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['item_name']; ?>">
                     <div class="details">
                         <h4 class="title"><?php echo $row['item_name']; ?></h4>
                         <h4 class="price">Price: ₦<?php echo number_format($row['price'], 2); ?></h4>
                         <a href="delete_item.php?item_id=<?php echo $row['item_id']; ?>" class="btn item-btn" >Delete item</a>
                     </div>
                 </div>
             </div>
             <?php } ?>
         </div>
     </div>
     <div class="con">
                <p>or</p>
         <button class="btn delete_btn" id="addButton" >Add item</button>
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
    <script>
        const hamburgerMenu = document.getElementById('hamburgerMenu');
const navLinks = document.getElementById('navLinks');

hamburgerMenu.addEventListener('click', function () {
    navLinks.classList.toggle('active');
});
    </script>
    <script >
        const addButton=document.getElementById('addButton');
        const deleteButtonButton=document.getElementById('deleteButton');
        const addForm=document.getElementById('add_item');
        const deleteForm=document.getElementById('delete_item');
        

        deleteButton.addEventListener('click', function () {
            addForm.style.display="none";
            deleteForm.style.display="block";
        });
        addButton.addEventListener('click', function () {
        addForm.style.display="block";
        deleteForm.style.display="none";
        });
    </script>

</body>
</html>
