<header>
    <nav class="navbar" aria-label="Main Navigation">
        <h1 class="logo">Book Nest</h1>
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