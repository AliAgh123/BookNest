<?php
require 'db.php';

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "<div class='product-item'>";
    echo "<h3>" . htmlspecialchars($product['title']) . "</h3>";
    echo "<p>$" . number_format($product['price'], 2) . "</p>";
    echo "<p>" . htmlspecialchars($product['description']) . "</p>";
    echo "<button onclick=\"addToCart('" . htmlspecialchars($product['id']) . "')\">Add to Cart</button>";
    echo "</div>";
}
?>
