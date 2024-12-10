<!-- --------------- Ali Abdel Ghaffar -------------------- -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Admin Dashboard Home</title>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
		<header>
			<nav class="navbar" aria-label="Main Navigation">
				<div class="leftSideNav">
					<button
						class="sidebar-toggle"
						aria-expanded="false"
						onclick="toggleSidebar()"
					>
						☰
					</button>
					<h1 class="logo">Book Nest</h1>
				</div>
				<button
					class="menu-toggle"
					aria-label="Toggle Menu"
					onclick="toggleMenu()"
				>
					☰
				</button>
				<div class="nav-container">
					<ul class="nav-menu">
						<li><a href="index.php">Home</a></li>
						<li><a href="products.php">Products</a></li>
						<li><a href="akbar_checkOut.php">CheckOut</a></li>
						<li><a href="About.php">About Us</a></li>
						<li><a href="profile.php">Profile</a></li>
						<li><a href="dashboardHome.php">Dashboard</a></li>
						<li id="cart-container">
							<a href="akbar_cart.php" id="cart-page-link">
								<i class="bi bi-cart3"></i>
								<span
									id="cart-count"
									class="badge rounded-pill bg-danger hidden"
									>0</span
								>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
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

					
					<section class="summary-cards">
						<div class="card">
							<h3>Total Sales</h3>
							<p>$20,000</p>
						</div>
						<div class="card">
							<h3>Orders</h3>
							<p>150</p>
						</div>
						<div class="card">
							<h3>New Customers</h3>
							<p>45</p>
						</div>
						<div class="card">
							<h3>Top-selling Book</h3>
							<p>Book Title</p>
						</div>
					</section>

					
					<section class="recent-activity">
						<h2>Recent Activity</h2>
						<ul>
							<li>Order #1234 - Shipped</li>
							<li>New Customer: John Doe</li>
							<li>Product Updated: "Book XYZ"</li>
							<li>New Review: "Book ABC"</li>
						</ul>
					</section>

					<section class="quick-actions">
						<h2>Quick Actions</h2>
						<div class="action-buttons">
							<a href="./productManagement.php">
								<button>
									Add New Product
								</button>
							</a>
							<a href="./orderManagement.php">
								<button>
									Process Orders
								</button>
							</a>
						</div>
					</section>
				</main>
			</div>
		</div>
		<?php include "footer.php" ?>
		<script src="js/dashboard.js"></script>
		<script src="js/nav.js"></script>
	</body>
</html>
