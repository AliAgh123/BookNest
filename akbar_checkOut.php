<?php
session_start();

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate total amount
$totalAmount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);

    // Simulate order processing (e.g., store order in database or send confirmation email)
    // In a real application, insert order data into the database and send an email
    $orderSuccess = true; // Simulate successful order placement

    if ($orderSuccess) {
        $_SESSION['cart'] = []; // Clear the cart after successful order
        $message = "Thank you, $name! Your order has been placed successfully.";
    } else {
        $message = "Sorry, there was an issue processing your order. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Checkout</title>
  <link rel="stylesheet" href="akbar_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <nav>
      <h1 class="logo">Book Nest</h1>
      <ul class="nav-menu">
        <li><a href="malak_homePage.php">Home</a></li>
        <li><a href="malak_products.php">Products</a></li>
        <li><a href="akbar_checkOut.php">CheckOut</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
    <section class="checkout-section">
      <h2>Checkout</h2>
      <div id="cart-summary">
        <h3>Your Cart</h3>
        <?php if (empty($_SESSION['cart'])): ?>
          <p>Your cart is empty.</p>
        <?php else: ?>
          <ul>
            <?php foreach ($_SESSION['cart'] as $item): ?>
              <li>
                <strong><?php echo htmlspecialchars($item['title']); ?></strong>
                - $<?php echo number_format($item['price'], 2); ?> 
                x <?php echo (int)$item['quantity']; ?>
              </li>
            <?php endforeach; ?>
          </ul>
          <p id="total-amount">Total Amount: $<?php echo number_format($totalAmount, 2); ?></p>
        <?php endif; ?>
      </div>

      <?php if (!empty($_SESSION['cart'])): ?>
        <form id="checkout-form" method="POST">
          <h3>Billing Details</h3>
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
          
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>

          <label for="address">Address:</label>
          <textarea id="address" name="address" required></textarea>

          <button type="submit" id="place-order">Place Order</button>
        </form>
      <?php endif; ?>

      <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 Book Nest. All rights reserved.</p>
  </footer>
  <script src="malak_functionalities.js"></script>
</body>
</html>
