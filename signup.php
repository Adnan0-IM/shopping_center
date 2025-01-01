<?php
session_start();
require 'conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // Get the selected role

    // Insert user into the database
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$userName', '$email', '$password', '$role')";
    
    if ($conn->query($query) === TRUE) {
        echo "Registration successful!";
        header('Location: login.php'); // Redirect to login after successful registration
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
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
          <li><a href="login.php" >Login</a></li>
          <li><a href="signup.php" >Sign Up</a></li>
        </ul>
      </nav>
    </header>
                    <section id="signup">
                        <h2>Create an account</h2>
                        <form action="signup.php" method="POST">
                            <div class="mb-3">
                                <label for="userName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="userName" name="userName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Register as</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user">User</option>
                                    <option value="IVM">Inventory Manager</option>
                                    <option value="salesperson">Salesperson</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                            <div class="down">
                <p>or</p>
                <a href="login.php" class="sign-in" id="logInButton">login</a>
            </div>
                        </form>
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
