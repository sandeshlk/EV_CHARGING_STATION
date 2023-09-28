<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    // User is already logged in. Redirect to booking page.
    header('Location: booking.php');
    exit;
  }
  if (isset($_POST['username']) && isset($_POST['password'])) {
    // Check login credentials
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'ev');
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    // Check if username and password are correct
    $result = mysqli_query($conn, "SELECT user_id FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($result) == 1) {
      // Login successful, store user id in session
      $row = mysqli_fetch_assoc($result);
      $_SESSION['user_id'] = $row['user_id'];
      

      // Redirect to booking page
      header('Location: booking.php');
      exit;
    }
    // Login failed
    $error = 'Invalid username or password';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
     /* Reset some default styles */
body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-size: cover;
    display: flex;
    justify-content: center; /* Horizontally center content */
    align-items: center; /* Vertically center content */
    min-height: 100vh; /* Ensure the page takes at least the full viewport height */
}

/* Login box styling */
.login-box {
    width: 280px;
    background-color: #fff;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    color: #191970;
}

/* Title styling */
.login-box h1 {
    font-size: 40px;
    border-bottom: 4px solid #191970;
    margin-bottom: 20px;
    padding: 13px;
}

/* Textbox styling */
.textbox {
    width: 100%;
    overflow: hidden;
    font-size: 20px;
    padding: 8px 0;
    margin: 8px 0;
    border-bottom: 1px solid #191970;
}

.fa {
    width: px; /* Remove this line, it's not needed */
    float: left; /* Remove this line, it's not needed */
    text-align: center; /* Remove this line, it's not needed */
}

.textbox input {
    border: none;
    outline: none;
    background: none;
    font-size: 18px;
    margin: 0 10px;
    width: 80%; /* Adjust the input width */
    padding: 5px; /* Adjust padding for better appearance */
}

/* Button styling */
.button {
    width: 100%;
    padding: 12px;
    background-color: #191970;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 18px;
    cursor: pointer;
    margin-top: 20px; /* Add margin to separate from textboxes */
}

    </style>
  </head>
  
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    
    <div class="login-box">
        <h1>User Login</h1>

        <form method="post">
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" id="username" placeholder="Username" name="username" value="">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" id="password" placeholder="Password" name="password" value="">
            </div>

            <input class="button" type="submit" name="login" value="Login">
        </form>
        
        <p>New user? <a href="newuser.php">Sign up</a></p>
    </div>
</body>
</html>
