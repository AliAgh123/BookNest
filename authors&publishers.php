<?php
include 'connectDb.php'; 


if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); 
    $delete_query = "DELETE FROM users WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        $success = "Record deleted successfully!";
    } else {
        $error = "Error deleting record: " . mysqli_error($conn);
    }
}


$query = "SELECT id, full_name, user_type, bio FROM users WHERE user_type IN ('author', 'publisher')";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Authors and Publishers Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style/dashboardStyle.css" />
    <link rel="stylesheet" href="style/malak_styles.css" />
</head>
<body class="dashboardBody">
    <?php include 'dashboardHeader.php'?>

    <div class="dashboardContainer">
        <aside class="sidebar" id="sidebar">
            <h2>Admin Dashboard</h2>
            <nav>
                <a href="./dashboardHome.php">Dashboard Home</a>
                <a href="./productManagement.php">Product Management</a>
                <a href="./orderManagement.php">Order Management</a>
                <a class="active" href="./authors&publishers.php">Authors & Publishers</a>
                <a href="./customersDashboard.php">Customers</a>
            </nav>
        </aside>

        
        <div class="rightSideDashboard">
            <div class="content">
              
                <header class="title-header">
                    <h1>Authors & Publishers Management</h1>
                    <p>Manage and view all authors and publishers registered on the platform.</p>
                </header>


                <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
                <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

                
                <section class="author-publisher-list">
                    <h2>Authors and Publishers List</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                                    <td><?= htmlspecialchars(ucfirst($row['user_type'])) ?></td>
                                    <td><?= htmlspecialchars($row['description']) ?></td>
                                    <td>
                                        <button class="delete-btn" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Book Nest. All rights reserved.</p>
    </footer>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = '?delete_id=' + id;
            }
        }
    </script>
    <script src="js/dashboard.js"></script>
    <script src="js/nav.js"></script>
</body>
</html>
