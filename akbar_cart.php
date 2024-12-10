<?php
session_start();
require 'connectDb.php'; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'clear') {
            $_SESSION['cart'] = [];
        }

        if ($action === 'checkout') {

            if (!isset($_SESSION['user_id'])) {
                echo "<p>You must be logged in to complete the purchase.</p>";
                exit;
            }

            $user_id = $_SESSION['user_id'];
            $shipping_address = htmlspecialchars(trim($_POST['shipping_address']));
            $billing_address = htmlspecialchars(trim($_POST['billing_address']));

            if (empty($_SESSION['cart'])) {
                echo "<p>Your cart is empty. Add items to checkout.</p>";
                exit;
            }

            $total_amount = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            $stmt = $conn->prepare("
                INSERT INTO orders (user_id, order_date, total_amount, shipping_address, billing_address, status)
                VALUES (?, NOW(), ?, ?, ?, 'pending')
            ");
            $stmt->bind_param("idss", $user_id, $total_amount, $shipping_address, $billing_address);

            if ($stmt->execute()) {
                $order_id = $stmt->insert_id;

                foreach ($_SESSION['cart'] as $item) {
                    $item_stmt = $conn->prepare("
                        INSERT INTO order_items (order_id, product_title, quantity, price)
                        VALUES (?, ?, ?, ?)
                    ");
                    $item_stmt->bind_param(
                        "isid",
                        $order_id,
                        $item['title'],
                        $item['quantity'],
                        $item['price']
                    );
                    $item_stmt->execute();
                }

                $_SESSION['cart'] = [];
                echo "<p>Order placed successfully! Your order ID is {$order_id}.</p>";
            } else {
                echo "<p>Error placing the order: " . $stmt->error . "</p>";
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
  <title>Book Nest - Cart</title>
  <link rel="stylesheet" href="style/akbar_styles.css">
  <link rel="stylesheet" href="style/malak_styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include "header.php"; ?>
<main>
  <section class="cart-section" aria-labelledby="cart-heading">
    <h2 id="cart-heading">Your Shopping Cart</h2>
    <div id="cart-items-container">
      <?php if (empty($_SESSION['cart'])): ?>
        <!-- <p>Your cart is empty.</p> -->
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
<?php include "footer.php" ?>
<script src="js/malak_functionalities.js"></script>
</body>
</html>

