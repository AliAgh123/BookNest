<?php

include 'connectDb.php';


$query = "SELECT id, full_name FROM users WHERE user_type = 'author'";
$result = mysqli_query($conn, $query);

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); 

    $delete_query = "DELETE FROM books WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        $success = "Product deleted successfully!";

    } else {
        $error = "Error deleting product: " . mysqli_error($conn);
    }
}

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    

    $book_query = "SELECT * FROM books WHERE id = '$edit_id'";
    $book_result = mysqli_query($conn, $book_query);
    $book = mysqli_fetch_assoc($book_result);

    $selected_author_id = $book['author_id'];
    header("Location: productManagement.php"); 
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $author_id = $_POST['author'];
    $genre = $_POST['genre'];
    $isbn = $_POST['isbn'];
    $format = $_POST['format'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];


    $cover_image = 'images/profileImages/profileDefault.jpg';  
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $cover_image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $cover_image);
    }

    if (isset($edit_id)) {

        $sql = "UPDATE books SET 
                title='$title', 
                author_id='$author_id', 
                description='$description', 
                genre='$genre', 
                price='$price', 
                isbn='$isbn', 
                cover_image='$cover_image', 
                stock='$stock', 
                format='$format' 
                WHERE id = '$edit_id'";



        if (mysqli_query($conn, $sql)) {
            $success = "Product updated successfully!";
        } else {
            $error = "Error updating product: " . mysqli_error($conn);
        }
    } else {

        $sql = "INSERT INTO books (title, author_id, description, genre, price, isbn, cover_image, stock, format) 
                VALUES ('$title', '$author_id', '$description', '$genre', '$price', '$isbn', '$cover_image', '$stock', '$format')";

        if (mysqli_query($conn, $sql)) {
            $success = "Product added successfully!";
        } else {
            $error = "Error adding product: " . mysqli_error($conn);
        }
    }
}

$books_query = "SELECT books.id, books.title, books.genre, books.format, books.price, books.stock, users.full_name AS author 
                FROM books 
                JOIN users ON books.author_id = users.id";
$books_result = mysqli_query($conn, $books_query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="style/dashboardStyle.css" />
    <link rel="stylesheet" href="style/malak_styles.css" />
</head>
<body class="dashboardBody">
        <?php include 'dashboardHeader.php'; ?>

    <div class="dashboardContainer">
        <aside class="sidebar" id="sidebar">
            <h2>Admin Dashboard</h2>
            <nav>
                <a href="./dashboardHome.php">Dashboard Home</a>
                <a class="active" href="./productManagement.php">Product Management</a>
                <a href="./orderManagement.php">Order Management</a>
                <a href="./authors&publishers.php">Authors & Publishers</a>
                <a href="./customersDashboard.php">Customers</a>
            </nav>
        </aside>

        <div class="rightSideDashboard">
            <main class="content">
                <header class="title-header">
                    <h1>Product Management</h1>
                    <p>Manage books, eBooks, and other inventory.</p>
                </header>

                <!-- Add New Product Form -->
                <section class="product-form">
                    <h2>Add / Edit Product</h2>
                    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
                    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title">Book Title:</label>
                        <input type="text" id="title" name="title" value="<?= isset($book) ? $book['title'] : '' ?>" required />

                        <label for="author">Author:</label>
                        <select id="author" name="author" required>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <option value="<?= $row['id'] ?>" 
                                    <?= (isset($selected_author_id) && $row['id'] == $selected_author_id) && isset($book) && $book['author_id'] == $row['id'] ? 'selected' : '' ?>
                                >
                                    <?= $row['full_name'] ?>
                                </option>
                            <?php } ?>
                       
                        </select>

                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" name="genre" value="<?= isset($book) ? $book['genre'] : '' ?>" required />

                        <label for="isbn">ISBN:</label>
                        <input type="text" id="isbn" name="isbn" value="<?= isset($book) ? $book['isbn'] : '' ?>" />

                        <label for="format">Format:</label>
                        <select id="format" name="format" required>
                            <option value="Paperback" <?= isset($book) && $book['format'] == 'Paperback' ? 'selected' : '' ?>>Paperback</option>
                            <option value="Hardcover" <?= isset($book) && $book['format'] == 'Hardcover' ? 'selected' : '' ?>>Hardcover</option>
                            <option value="eBook" <?= isset($book) && $book['format'] == 'eBook' ? 'selected' : '' ?>>eBook</option>
                        </select>

                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" step="1" value="<?= isset($book) ? $book['price'] : '' ?>" required />

                        <label for="stock">Stock Quantity:</label>
                        <input type="number" id="stock" name="stock" value="<?= isset($book) ? $book['stock'] : '' ?>" required />

                        <label for="image">Cover Image:</label>
                        <input type="file" id="image" name="image" />

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="4" required><?= isset($book) ? $book['description'] : '' ?></textarea>

                        <button type="submit">Save Product</button>
                    </form>
                </section>

                <!-- Product List Table -->
                <section class="product-table">
                    <h2>Product Inventory</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Format</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($book = mysqli_fetch_assoc($books_result)) { ?>
                                <tr>
                                    <td><?= $book['id'] ?></td>
                                    <td><?= $book['title'] ?></td>
                                    <td><?= $book['author'] ?></td>
                                    <td><?= $book['genre'] ?></td>
                                    <td><?= $book['format'] ?></td>
                                    <td>$<?= number_format($book['price'], 2) ?></td>
                                    <td><?= $book['stock'] ?></td>
                                    <td>
                                        <a href="?edit_id=<?= $book['id'] ?>"><button class="edit-btn">Edit</button></a>
                                        <button class="delete-btn" onclick="confirmDelete(<?= $book['id'] ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="js/dashboard.js"></script>
    <script>
        function confirmDelete(bookId) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = '?delete_id=' + bookId;
            }
        }
    </script>

</body>
</html>
