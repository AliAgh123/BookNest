<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Nest | About Us</title>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Old+London&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  
  <?php
  include "header.php"
  ?>

  <main>
    <div class="top-page-about">
      <div class="background-image"></div>
      <div class="overlay-text">
        <h1>About Us</h1>
        <p>We are the HTML Warriors, your trusted partner in the world of literature.</p>
      </div>
    </div>

    <section class="about-details container my-5">
      <h2>Our Mission</h2>
      <p>
        At HTML Warriors, we are dedicated to transforming the way you explore and access reading materials. Our online bookstore offers a wide selection of books, eBooks, and other literary treasures to ignite your imagination and inspire your mind.
      </p>

      <h2>What We Offer</h2>
      <ul>
        <li>A diverse collection of physical books and eBooks across various genres.</li>
        <li>Seamless online shopping experience for all book lovers.</li>
        <li>Regular updates and recommendations tailored to your interests.</li>
      </ul>

      <h2>Why Choose Us?</h2>
      <p>
        With a passion for storytelling and a commitment to quality, we aim to provide a platform that caters to both avid readers and casual browsers. Join us in our mission to make reading more accessible, enjoyable, and exciting.
      </p>

      <h2>Meet Our Team</h2>
      <p>
        Our team is composed of four passionate individuals who share a common goal: to offer an amazing online bookstore experience for all book lovers.
      </p>

      <ul>
        <li><strong>Keven Karam</strong> - Co-founder and Content Specialist</li>
        <li><strong>Ali Abdel Ghaffar</strong> - Co-founder and Technical Lead</li>
        <li><strong>Ali Akbar Fakih</strong> - Developer and User Experience Designer</li>
        <li><strong>Malak Seif Eddine</strong> - Marketing and Customer Relations</li>
      </ul>

      <h2>Join Our Journey</h2>
      <p>
        We invite you to explore our collection of books and join us on our mission to spread the joy of reading. Whether you are an avid reader or just starting your literary journey, Book Nest is here to be your trusted guide.
      </p>
    </section>
  </main>

  <?php
  include "footer.php"
  ?>
</body>
</html>
