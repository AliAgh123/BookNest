<?php
require 'connectDb.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = $error = "";

$stmt = $conn->prepare("SELECT full_name, email, phone, address, user_type, bio, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    $error = "User data not found.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full-name']);
    $email = trim($_POST['email']);
    $oldPassword = trim($_POST['oldPassword']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $user_type = $_POST['user-type'];
    $bio = trim($_POST['bio']);

    

    if (password_verify($oldPassword, $user['password'])) {

        $updateStmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, password = ?, phone = ?, address = ?, user_type = ?, bio = ? WHERE id = ?");
        $updateStmt->bind_param("sssssssi", $full_name, $email, password_hash($password, PASSWORD_BCRYPT), $phone, $address, $user_type, $bio, $user_id);

        if ($updateStmt->execute()) {
            $success = "Profile updated successfully!";

            header("Location: profile.php");
            exit();
        } else {
            $error = "Failed to update profile.";
        }
        
    } else {
        $error = "Incorrect password.";
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>User Profile</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="stylesheet" href="style/profileStyles.css" />
        <link rel="stylesheet" href="style/malak_styles.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
    <body>
        <?php include 'header.php'; ?>


        <div class="profile-container">
            
            <div class="profile-sidebar">
                <div class="profile-picture">
                    <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" />
                </div>
                <h2><?php echo htmlspecialchars($user['full_name']); ?></h2>
                <p class="location"><?php echo htmlspecialchars($user['address']); ?></p>

                
                <div class="bio">
                    <p><?php echo htmlspecialchars($user['bio'] ?? "No bio available."); ?></p>
                </div>
            </div>

           
            <div class="profile-details">
                <div class="basic-info">
                <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
                <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
                    <h3>Basic Information</h3>
                    <form action="profile.php" method="POST" class="edit-profile-form">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required />

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />

                        <label for="oldPassword">OldPassword</label>
                        <input type="password" id="oldPassword" name="oldPassword" value="" required />

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="" required />


                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" />

                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" />

                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>

                        <label for="user-type">User Type</label>
                        <select id="user-type" name="user-type">
                            <option value="reader" <?php echo $user['user_type'] == 'reader' ? 'selected' : ''; ?>>Reader</option>
                            <option value="author" <?php echo $user['user_type'] == 'author' ? 'selected' : ''; ?>>Author</option>
                            <option value="publisher" <?php echo $user['user_type'] == 'publisher' ? 'selected' : ''; ?>>Publisher</option>
                        </select>

                        <button type="submit" class="save-btn">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
        <script src="js/nav.js"></script>
    </body>
</html>
