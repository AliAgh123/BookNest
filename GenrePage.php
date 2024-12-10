<?php
session_start();
require 'connectDb.php'; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $book = [
        'title' => htmlspecialchars($_POST['title']),
        'price' => (float)$_POST['price'],
        'author' => htmlspecialchars($_POST['author'])
    ];

    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['title'] === $book['title']) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $book;
    }

    header('Location: GenrePage.php');
    exit;
}

$query = "SELECT title, price, author FROM books";
$result = $conn->query($query);

if ($result === false) {
    die("Error fetching books: " . $conn->error);
}

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest | Genre Page</title>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include "header.php"
?>

  <main>
    <section class="book-list">
      <h2>Books in Fiction</h2>
      <div class="book-grid">
        <?php foreach ($books as $book): ?>
          <div class="book-item">
            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($book['price'], 2); ?></p>
            <form method="POST">
              <input type="hidden" name="action" value="add_to_cart">
              <input type="hidden" name="title" value="<?php echo htmlspecialchars($book['title']); ?>">
              <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
              <input type="hidden" name="author" value="<?php echo htmlspecialchars($book['author']); ?>">
              <button type="submit">Add to Cart</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

<?php include "footer.php" ?>
</body>
</html>

