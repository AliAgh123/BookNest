<?php include 'connectDb.php'; ?>
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
                <li><a href="index.html">Home</a></li>
                <li><a href="malak_products.html">Products</a></li>
                <li><a href="akbar_checkOut.html">CheckOut</a></li>
                <li><a href="About.html">About Us</a></li>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="dashboardHome.html">Dashboard</a></li>
                <li id="cart-container">
                    <a href="akbar_cart.html" id="cart-page-link">
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