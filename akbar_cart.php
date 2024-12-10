<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Cart</title>
  <link rel="stylesheet" href="akbar_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <?php
  
  session_start();

  
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }

 
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
      $item = [
          'title' => $_POST['title'],
          'price' => (float)$_POST['price'],
          'quantity' => (int)$_POST['quantity']
      ];
      $_SESSION['cart'][] = $item;
  }


  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {
      $_SESSION['cart'] = [];
  }
  ?>

<?php
include "header.php"
?>

  <main>
    <section class="cart-section" aria-labelledby="cart-heading">
      <h2 id="cart-heading">Your Shopping Cart</h2>
      <div id="cart-items-container">
        <?php if (empty($_SESSION['cart'])): ?>
          <p>Your cart is empty.</p>
        <?php else: ?>
          <ul>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
              <li>
                <strong><?php echo htmlspecialchars($item['title']); ?></strong>
                - $<?php echo number_format($item['price'], 2); ?>
                x <?php echo (int)$item['quantity']; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
      <div class="cart-actions">
        <form method="POST">
          <input type="hidden" name="action" value="clear">
          <button type="submit" id="clear-cart">Clear Cart</button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Book Nest. All rights reserved.</p>
  </footer>
  <script src="malak_functionalities.js"></script>
</body>
</html>
