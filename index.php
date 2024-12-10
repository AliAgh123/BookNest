<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Book Nest - Home</title>
		<link rel="stylesheet" href="style/malak_styles.css" />
		<link
			href="https://fonts.googleapis.com/css2?family=Old+London&family=EB+Garamond:wght@400;700&display=swap"
			rel="stylesheet"
		/>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
			rel="stylesheet"
		/>
    <?php
session_start();
require 'connectDb.php'; 

// Modify the query to join the books table with the authors table
$query = "SELECT books.title, books.price, books.description, users.full_name AS author_name 
          FROM books
          JOIN users ON books.author_id = users.id
          LIMIT 3"; 

$result = $conn->query($query);

if ($result === false) {
    die("Error fetching books: " . $conn->error);
}

$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}
?>


	</head>
	<body class="homepage">
  <?php 
    include "header.php";
  ?>



		<main>
			<section class="hero">
				<h2>Welcome to Book Nest</h2>
				<p>Your one-stop destination for a wide range of books.</p>
				<button onclick="window.location.href='products.php'">
					Explore Now
				</button>
			</section>

			<section class="product-list">
				<h2>Featured Books</h2>
				
        <?php foreach ($books as $book): ?>
          <div class="product-item">
              <h3><?php echo $book['title']; ?></h3>
              <p>$<?php echo $book['price']; ?></p>
              <p><?php echo $book['description']; ?> by <?php echo $book['author_name']; ?></p>
          </div>
      <?php endforeach; ?>
			</section>
		</main>

	    <?php include "footer.php" ?>
		<script src="js/malak_functionalities.js"></script>
		<script src="js/nav.js"></script>
	</body>
</html>
