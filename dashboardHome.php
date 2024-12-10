<?php
session_start();

require 'connectDb.php';

$recent_orders_query = "SELECT orders.order_id, orders.order_date, users.full_name, orders.status
                        FROM orders
                        JOIN users ON orders.user_id = users.id
                        ORDER BY orders.order_date DESC LIMIT 5";
$recent_orders_result = $conn->query($recent_orders_query);


$recent_customers_query = "SELECT id, full_name, email 
                           FROM users WHERE user_type = 'reader' LIMIT 5";
$recent_customers_result = $conn->query($recent_customers_query);


$recent_products_query = "SELECT id, title, genre, price, format FROM books LIMIT 5";
$recent_products_result = $conn->query($recent_products_query);


$total_sales_query = "SELECT SUM(total_amount) AS total_sales 
                      FROM orders
                      WHERE orders.status IN ('shipped', 'delivered')";
$total_sales_result = $conn->query($total_sales_query);
$total_sales = 0; 
if ($total_sales_result) {
    $row = $total_sales_result->fetch_assoc();
    $total_sales = $row['total_sales'] ?? 0;
}


$total_orders_query = "SELECT COUNT(*) AS total_orders FROM orders";
$total_orders_result = $conn->query($total_orders_query);
$total_orders = 0; 
if ($total_orders_result) {
    $row = $total_orders_result->fetch_assoc();
    $total_orders = $row['total_orders'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard Home</title>
    <link rel="stylesheet" href="style/dashboardStyle.css" />
    <link rel="stylesheet" href="style/malak_styles.css" />
</head>
<body class="dashboardBody">
    <?php include "dashboardHeader.php" ?>
    <div class="dashboardContainer">
        <aside class="sidebar" id="sidebar">
            <h2>Admin Dashboard</h2>
            <nav>
                <a class="active" href="./dashboardHome.php">Dashboard Home</a>
                <a href="./productManagement.php">Product Management</a>
                <a href="./orderManagement.php">Order Management</a>
                <a href="./authors&publishers.php">Authors & Publishers</a>
                <a href="./customersDashboard.php">Customers</a>
            </nav>
        </aside>
        <div class="rightSideDashboard">
            <main class="content">
                <header class="title-header">
                    <h1>Welcome to the Dashboard</h1>
                    <p>Overview of your bookstore’s performance</p>
                </header>

                <!-- Summary Cards -->
                <section class="summary-cards">
                    <div class="card">
                        <h3>Total Sales</h3>
                        <p>$<?php echo number_format($total_sales, 2); ?></p>
                    </div>
                    <div class="card">
                        <h3>Total Orders</h3>
                        <p><?php echo $total_orders; ?></p>
                    </div>
                    <div class="card">
                        <h3>New Customers</h3>
                        <p><?php echo $recent_customers_result->num_rows; ?></p>
                    </div>
                    <div class="card">
                        <h3>Top-selling Book</h3>
                        <p>Book Title</p>
                    </div>
                </section>

                <!-- Recent Activity -->
                <section class="recent-activity">
                    <h2>Recent Activity</h2>
                    <ul>
                        <!-- Recent Orders -->
                        <li><strong>Recent Orders:</strong></li>
                        <?php while ($order = $recent_orders_result->fetch_assoc()) { ?>
                            <li>
                                Order #<?php echo $order['order_id']; ?> - 
                                Customer: <?php echo $order['full_name']; ?> - 
                                Status: <?php echo ucfirst($order['status']); ?> - 
                                Date: <?php echo date("F j, Y", strtotime($order['order_date'])); ?>
                            </li>
                        <?php } ?>

                        <!-- Recent Customers -->
                        <li><strong>New Customers:</strong></li>
                        <?php while ($customer = $recent_customers_result->fetch_assoc()) { ?>
                            <li>
                                Customer: <?php echo $customer['full_name']; ?> - 
                                Email: <?php echo $customer['email']; ?>
                            </li>
                        <?php } ?>

                        <!-- Recent Products -->
                        <li><strong>Product Updates:</strong></li>
                        <?php while ($product = $recent_products_result->fetch_assoc()) { ?>
                            <li>
                                Product: <?php echo $product['title']; ?> - 
                                Genre: <?php echo $product['genre']; ?> - 
                                Price: $<?php echo number_format($product['price'], 2); ?> - 
                                Format: <?php echo $product['format']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </section>

                <!-- Quick Actions -->
                <section class="quick-actions">
                    <h2>Quick Actions</h2>
                    <div class="action-buttons">
                        <a href="./productManagement.php">
                            <button>Add New Product</button>
                        </a>
                        <a href="./orderManagement.php">
                            <button>Process Orders</button>
                        </a>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <?php include "footer.php" ?>
	<script src="js/dashboard.js"></script>
</body>
</html>
