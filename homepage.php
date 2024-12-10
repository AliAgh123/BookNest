<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Home</title>
  <link rel="stylesheet" href="malak_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <?php
  
  $books = [
      ["title" => "The Great Gatsby", "price" => 8.43],
      ["title" => "I Wrote a Book About You", "price" => 10.79],
      ["title" => "We Were Liars", "price" => 15.09],
  ];

  echo "<div class='php-section'>";
  echo "<h2>PHP-Generated Content:</h2>";
  echo "<ul>";
  foreach ($books as $book) {
      echo "<li>{$book['title']} - \$" . number_format($book['price'], 2) . "</li>";
  }
  echo "</ul>";
  echo "</div>";
  ?>
  
  <header>
    <nav aria-label="Main Navigation">
      <h1 class="logo">Book Nest</h1>
      <ul class="nav-menu">
        <li><a href="malak_homePage.html">Home</a></li>
        <li><a href="malak_products.html">Products</a></li>
        <li><a href="About.html">About Us</a></li> 
        
        <li id="cart-container">
          <a href="akbar_cart.html" id="cart-page-link">
            <i class="bi bi-cart3">
            <span id="cart-count" class="badge rounded-pill bg-danger hidden">0</span>
            </i>
          </a>
        </li>
      </ul>
    </nav>
  </header>
  
  <main>
    <section class="hero">
      <h2>Welcome to Book Nest</h2>
      <p>Your one-stop destination for a wide range of books.</p>
      <button onclick="window.location.href='malak_products.html'">Explore Now</button>
    </section>
    
    <section class="product-list">
      <h2>Popular Classics</h2>
      <div class="product-item">
        <h3>The Great Gatsby</h3>
        <p>$8.43</p>
        <p>A classic novel by F. Scott Fitzgerald.</p>
        <button>Buy Now</button>
      </div>
      <div class="product-item">
        <h3>I Wrote a Book About You</h3>
        <p>$10.79</p>
        <p>A fun, fill-in-the-blank book by M. H. Clark.</p>
        <button>Buy Now</button>
      </div>
      <div class="product-item">
        <h3>We Were Liars</h3>
        <p>$15.09</p>
        <p>by E.Lockhart</p>
        <button>Buy Now</button>
      </div>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2024 Book Nest. All rights reserved.</p>
  </footer>
  <script src="malak_functionalities.js"></script>
</body>
</html>

