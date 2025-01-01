<?php
session_start();
require 'conn.php';

if (isset($_POST['login'])) {
    $userName = $_POST['userName'];
    // $email = $_POST['email'];
    $password = $_POST['password'];

     // Fetch the user from the database
     $query = "SELECT * FROM users WHERE username='$userName'";
     $result = $conn->query($query);
     $user = $result->fetch_assoc();
 
     if ($user && password_verify($password, $user['password'])) {
         // Check if the user is an admin or a regular user
         if ($user['role'] === 'IVM') {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = 'IVM';
                header('Location: admin_dashboard.php');
          } elseif ($user['role'] === 'salesperson') {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = 'salesperson';
                header('Location: salesperson.php');
          } elseif ($user['role'] === 'manager') {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = 'manager';
                header('Location: manager.php');
          } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = 'user';
                header('Location: user_dashboard.php');
         }
     } else {
         echo "Invalid email or password!";
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
        <div class="hamburger" id="hamburger">&#9776;</div>
        <ul id="links">
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php" >Login</a></li>
          <li><a href="signup.php" >Sign Up</a></li>
        </ul>
      </nav>
    </header>
    <div class="container mt-5">
  
                
                    <section id="login">

                        <h2>Login</h2>
                        <form action="login.php" method="POST">
                            <div>
                                <label for="username">Username:</label>
                                <input type="text" id="userName" name="userName" required>
                                <!-- <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required> -->
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            <div class="sign-in">
                                <p>Don't have an account? <a href="signup.php">Signup here</a></p>
                                <p><a href="index.php">Go back to Home</a></p>
                            </div>
                        </form>
                       
                    </section>
                   

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
