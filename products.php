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
  
  $products = [
      ["title" => "Atomic Habits", "price" => 13.97, "author" => "James Clear"],
      ["title" => "Iron Flame (The Empyrean, 2)", "price" => 10.98, "author" => "Rebecca Yarros"],
      ["title" => "The 48 Laws of Power", "price" => 18.00, "author" => "Robert Greene"],
      ["title" => "The Psychology of Money", "price" => 9.03, "author" => "Morgen Housel"],
      ["title" => "Stop Overthinking", "price" => 6.96, "author" => "Nick Trenton"],
      ["title" => "Don't Believe Everything You Think", "price" => 7.99, "author" => "Joseph Nguyen"],
      ["title" => "It Starts with Us", "price" => 20.54, "author" => "Colleen Hoover"],
      ["title" => "It Ends with Us", "price" => 21.78, "author" => "Colleen Hoover"],
      ["title" => "The Housemaid", "price" => 7.05, "author" => "Freda McFadden"],
      ["title" => "The Seven Husbands of Evelyn Hugo", "price" => 16.92, "author" => "Taylor Jenkins Reid"],
      ["title" => "Interesting Facts For Curious Minds", "price" => 10.59, "author" => "Jordan Moore"],
      ["title" => "I Love You to the Moon and Back", "price" => 5.79, "author" => "Amelia Hepworth"]
  ];
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

