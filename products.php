<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Products</title>
  <link rel="stylesheet" href="style/malak_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Add Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('https://c4.wallpaperflare.com/wallpaper/526/8/1002/library-interior-interior-design-books-wallpaper-preview.jpg')
		no-repeat center center fixed;
	background-size: cover;">
<?php
  session_start();
  require 'connectDb.php'; 
  
  $query = "SELECT books.id, books.title, books.price, books.description, books.cover_image, users.full_name  AS author_name 
            FROM books
            JOIN users ON books.author_id = users.id"; 
  $result = $conn->query($query);
  
  if ($result === false) {
      die("Error fetching products: " . $conn->error);
  }
  
  $products = [];
  while ($row = $result->fetch_assoc()) {
      $products[] = $row;
  }
?>

<?php
include "header.php"
?>
  
  <main>
    <section class="product-list" aria-labelledby="products-heading">
      <h2 id="products-heading">Our Collection</h2>
      <div class="container">
        <div class="row">
          <?php
          foreach ($products as $product) {
              echo "<div class='col-lg-4 col-md-6 col-sm-12 mb-4'>";
              echo "<div class='card shadow-sm'>";
              echo "<img src='{$product['cover_image']}' class='card-img-top' alt='book image'>";
              echo "<div class='card-body'>";
              echo "<h5 class='card-title'>{$product['title']}</h5>";
              echo "<p class='card-text'>\${$product['price']}</p>";
              echo "<p class='card-text'>by {$product['author_name']}</p>";
              echo "<p class='card-text'>{$product['description']}</p>";

              echo "<button type='button' class='btn' onclick=\"addToCart({$product['id']}, '{$product['title']}', {$product['price']})\">
        Add to Cart
      </button>";
              echo "</div>";
              echo "</div>"; 
              echo "</div>";
          }
          ?>
        </div>
      </div>
    </section>
  </main>
  
  <?php include "footer.php" ?>
  <script src="js/malak_functionalities.js"></script>
  <!-- Add Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
