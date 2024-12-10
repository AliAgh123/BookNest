<?php

include 'connectDb.php';

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM users WHERE id = $delete_id AND user_type = 'reader'";
    if (mysqli_query($conn, $sql_delete)) {
        $success = "customer deleted successfully!";

    } else {
        $error = "Error deleting customer: " . mysqli_error($conn);
    }

}

$query = "SELECT id, full_name, email, phone, address FROM users WHERE user_type = 'reader'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Customer Management</title>
        <link
            href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="style/dashboardStyle.css" />
        <link rel="stylesheet" href="style/malak_styles.css" />
    </head>
    <body class="dashboardBody">
        <!-- Navbar -->
        <?php include 'dashboardHeader.php' ?>

        <div class="dashboardContainer">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <h2>Admin Dashboard</h2>
                <nav>
                    <a href="./dashboardHome.php">Dashboard Home</a>
                    <a href="./productManagement.php">Product Management</a>
                    <a href="./orderManagement.php">Order Management</a>
                    <a href="./authors&publishers.php">Authors & Publishers</a>
                    <a class="active" href="./customersDashboard.php">Customers</a>
                </nav>
            </aside>

            <!-- Main Content -->
            <div class="rightSideDashboard">
                <div class="content">
                    <!-- Page Header -->
                    <header class="title-header">
                        <h1>Customer Management</h1>
                        <p>View and manage customers registered on the platform.</p>
                    </header>

                    <!-- Table of Readers -->
                    <section class="customer-list">
                        <h2>Customer List</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['id']); ?></td>
                                            <td><?= htmlspecialchars($row['full_name']); ?></td>
                                            <td><?= htmlspecialchars($row['email']); ?></td>
                                            <td><?= htmlspecialchars($row['phone']); ?></td>
                                            <td><?= htmlspecialchars($row['address']); ?></td>
                                            <td>
                                                <a href="?delete_id=<?= $row['id']; ?>">
                                                    <button class="delete-btn">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">No customers found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Book Nest. All rights reserved.</p>
        </footer>
        <script src="js/dashboard.js"></script>
        <script src="js/nav.js"></script>
    </body>
</html>