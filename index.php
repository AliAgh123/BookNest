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
	</head>
	<body class="homepage">
  <?php 
    include "header.php";
  ?>

		<main>
			<section class="hero">
				<h2>Welcome to Book Nest</h2>
				<p>Your one-stop destination for a wide range of books.</p>
				<button onclick="window.location.href='malak_products.html'">
					Explore Now
				</button>
			</section>

			<section class="product-list">
				<h2>Featured Books</h2>
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
			</section>
		</main>

		<footer>
			<p>&copy; 2024 Book Nest. All rights reserved.</p>
		</footer>
		<script src="js/malak_functionalities.js"></script>
		<script src="js/nav.js"></script>
	</body>
</html>
