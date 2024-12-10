<?php
session_start();
require 'connectDb.php'; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$totalAmount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        $message = "<p>You must be logged in to place an order.</p>";
    } else {
        $user_id = $_SESSION['user_id'];
        $shipping_address = htmlspecialchars($_POST['shipping_address']);
        $billing_address = htmlspecialchars($_POST['billing_address']);


        if (empty($_SESSION['cart'])) {
            $message = "<p>Your cart is empty. Add items to checkout.</p>";
        } else {

            $stmt = $conn->prepare("
                INSERT INTO orders (user_id, total_amount, shipping_address, billing_address, status)
                VALUES (?, ?, ?, ?, 'pending')
            ");
            $stmt->bind_param("idss", $user_id, $totalAmount, $shipping_address, $billing_address);

            if ($stmt->execute()) {
                $order_id = $stmt->insert_id; 


                foreach ($_SESSION['cart'] as $book_id => $item) {
                    $quantity = $item['quantity'];
                    $price_at_time = $item['price'];

                    $item_stmt = $conn->prepare("
                        INSERT INTO order_items (order_id, book_id, quantity, price_at_time)
                        VALUES (?, ?, ?, ?)
                    ");
                    $item_stmt->bind_param("iiid", $order_id, $book_id, $quantity, $price_at_time);

                    if (!$item_stmt->execute()) {
                        $message = "<p>Error saving item: " . $item_stmt->error . "</p>";
                        break;
                    }
                }

                // Clear the cart after successful order placement
                if (!isset($message)) {
                    $_SESSION['cart'] = [];
                    $message = "<p>Thank you! Your order has been placed successfully.</p>";
                }
            } else {
                $message = "<p>Sorry, there was an issue processing your order. Please try again.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest - Checkout</title>
  <link rel="stylesheet" href="style/akbar_styles.css">
  <link rel="stylesheet" href="style/malak_styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include "header.php"; ?>

<main class="container">
  <section class="checkout-section">
    <h2>Checkout</h2>

    <!-- Display cart summary -->
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

    <!-- Checkout form -->
    <?php if (!empty($_SESSION['cart'])): ?>
      <form id="checkout-form" method="POST">
        <h3>Shipping and Billing Details</h3>
        <label for="shipping_address">Shipping Address:</label>
        <textarea id="shipping_address" name="shipping_address" required></textarea>
        
        <label for="billing_address">Billing Address:</label>
        <textarea id="billing_address" name="billing_address" required></textarea>

        <button type="submit" id="place-order">Place Order</button>
      </form>
    <?php endif; ?>

    <!-- Display success or error message -->
    <?php if (isset($message)): ?>
      <div class="message">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>
  </section>
</main>

<?php include "footer.php" ?>
<script src="js/malak_functionalities.js"></script>
</body>
</html>
