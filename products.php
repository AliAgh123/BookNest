<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Products</title>
  <link rel="stylesheet" href="malak_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php
  
  session_start();
  require 'connectDb.php'; 
  

  $query = "SELECT title, price, author FROM products";
  $result = $conn->query($query);
  
  if ($result === false) {
      die("Error fetching products: " . $conn->error);
  }
  
  $products = [];
  while ($row = $result->fetch_assoc()) {
      $products[] = $row;
  }
  ?>
  
  <header>
    <nav aria-label="Main Navigation">
      <h1 class="logo">Book Nest</h1>
      <ul class="nav-menu">
        <li><a href="malak_homePage.html">Home</a></li>
        <li><a href="malak_products.html">Products</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li id="cart-container">
          <a href="akbar_cart.html" id="cart-page-link">
            <i class="bi bi-cart3"></i>
            <span id="cart-count" class="badge rounded-pill bg-danger hidden">0</span>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  
  <main>
    <section class="product-list" aria-labelledby="products-heading">
      <h2 id="products-heading">Our Collection</h2>
      <?php
      foreach ($products as $product) {
          echo "<div class='product-item'>";
          echo "<h3>{$product['title']}</h3>";
          echo "<p>\${$product['price']}</p>";
          echo "<p>by {$product['author']}</p>";
          echo "<button type='button' aria-label='Add {$product['title']} to Cart'>Add to Cart</button>";
          echo "</div>";
      }
      ?>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2024 Book Nest. All rights reserved.</p>
  </footer>
  <script src="malak_functionalities.js"></script>
</body>
</html>

