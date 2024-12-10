<?php
session_start();
require 'connectDb.php'; 

$error = ''; 
$success = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $user_type = trim($_POST['user_type']);
    $bio = trim($_POST['bio']);


    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields marked with * are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "An account with this email already exists.";
        } else {

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);


            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, phone, address, user_type, bio, profile_image) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $default_image = 'images/profileDefault.jpg';
            $stmt->bind_param("ssssssss", $full_name, $email, $hashed_password, $phone, $address, $user_type, $bio, $default_image);

            if ($stmt->execute()) {
                $success = "Account created successfully. You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sign Up</title>
</head>
<body>

    <h2>Sign Up</h2>


    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <form action="signup.php" method="POST">
        <label for="full_name">Full Name *</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password *</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password *</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Address</label>
        <input type="text" id="address" name="address"><br><br>

        <label for="user_type">User Type</label>
        <select id="user_type" name="user_type">
            <option value="reader" selected>Reader</option>
            <option value="author">Author</option>
            <option value="publisher">Publisher</option>
        </select><br><br>

        <label for="bio">Bio</label>
        <textarea id="bio" name="bio" rows="4" cols="50"></textarea><br><br>

        <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>
