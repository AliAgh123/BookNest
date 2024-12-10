<?php
session_start(); 
require 'connectDb.php'; 

$error = ''; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {

        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc(); 


            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];

                header("Location: profile.php");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with that email address.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>
    

    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>


    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Book Nest</title>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body style="background: url('library-background.jpg') center/cover no-repeat;">

  <div class="overlay"></div>

  <div class="auth-card">
    <h1 class="auth-title">Login to Book Nest</h1>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      <button type="submit" class="btn btn-login">Login</button>
    </form>
    <p class="toggle-text">Don't have an account? <a href="signup.php">Sign up</a></p>
  </div>

</body>
</html>
