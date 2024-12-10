<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$input = json_decode(file_get_contents('php://input'), true);


if (isset($input['book_id'], $input['title'], $input['price'])) {
    $book_id = $input['book_id'];
    $title = $input['title'];
    $price = $input['price'];


    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id]['quantity'] += 1; 
    } else {
        $_SESSION['cart'][$book_id] = [
            'title' => $title,
            'price' => $price,
            'quantity' => 1
        ];
    }


    echo json_encode([
        'success' => true,
        'cart' => $_SESSION['cart']
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
}
?>
