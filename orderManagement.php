<?php

include('connectDb.php');


$sql = "SELECT orders.order_id, users.full_name AS customer_name, orders.order_date, orders.total_amount, orders.status 
        FROM orders 
        JOIN users ON orders.user_id = users.id";
        
if (isset($_GET['orderSearch']) && !empty($_GET['orderSearch'])) {
    $search = $_GET['orderSearch'];
    $sql .= " WHERE orders.order_id LIKE '%$search%' OR users.name LIKE '%$search%'";
}

if (isset($_GET['status']) && $_GET['status'] != 'all') {
    $status = $_GET['status'];
    $sql .= " AND orders.status = '$status'";
}

if (isset($_GET['date']) && $_GET['date'] == 'newest') {
    $sql .= " ORDER BY orders.order_date DESC";
} else {
    $sql .= " ORDER BY orders.order_date ASC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style/dashboardStyle.css" />
    <link rel="stylesheet" href="style/malak_styles.css" />
</head>
<body class="dashboardBody">
    <?php include "dashboardHeader.php" ?>
    <div class="dashboardContainer">
        <aside class="sidebar" id="sidebar">
            <h2>Admin Dashboard</h2>
            <nav>
                <a href="./dashboardHome.php">Dashboard Home</a>
                <a href="./productManagement.php">Product Management</a>
                <a class="active" href="./orderManagement.php">Order Management</a>
                <a href="./authors&publishers.php">Authors & Publishers</a>
                <a href="./customersDashboard.php">Customers</a>
            </nav>
        </aside>
        <div class="rightSideDashboard">
            <main class="content">
                <header class="title-header">
                    <h1>Order Management</h1>
                    <p>View, update, and manage customer orders.</p>
                </header>

                <section class="order-filters">
                    <form class="search-form" action="#" method="get">
                        <input type="text" name="orderSearch" placeholder="Search by Order ID or Customer Name" />
                        <button type="submit">Search</button>
                    </form>
                    <div class="filter-options">
                        <label for="statusFilter">Status:</label>
                        <select id="statusFilter" name="status">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <label for="dateFilter">Sort by Date:</label>
                        <select id="dateFilter" name="date">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                        </select>
                    </div>
                </section>

                <section class="orders-table">
                    <h2>Orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td>#<?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><?php echo $row['order_date']; ?></td>
                                        <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><span class="status <?php echo $row['status']; ?>"><?php echo ucfirst($row['status']); ?></span></td>
                                        <td>
                                            <button class="delete-btn">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No orders found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>
	<?php include "footer.php" ?>
    <script src="js/dashboard.js"></script>
</body>
</html>

<?php $conn->close(); ?>
