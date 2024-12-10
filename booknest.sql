CREATE DATABASE booknest;

USE booknest;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    user_type ENUM('reader', 'author', 'publisher') DEFAULT 'reader',
    bio VARCHAR(255) DEFAULT NULL,
    profile_image VARCHAR(255) DEFAULT 'images/profileImages/profileDefault.jpg'
);


CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT NOT NULL,
    description TEXT,
    genre VARCHAR(100),
    price DECIMAL(10, 2) NOT NULL,
    isbn VARCHAR(13) UNIQUE,
    cover_image VARCHAR(255) DEFAULT 'images/bookImages/coverImage.gif',
    stock INT DEFAULT 0,
    format ENUM('eBook', 'Hardcover', 'Paperback') NOT NULL,
    FOREIGN KEY (author_id) REFERENCES users(id) 
);


CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,            
    user_id INT NOT NULL,                                
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,      
    total_amount DECIMAL(10, 2) NOT NULL,               
    shipping_address VARCHAR(255) NOT NULL,             
    billing_address VARCHAR(255) NOT NULL,
    status ENUM('pending', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    book_id INT NOT NULL,
    quantity INT NOT NULL,
    price_at_time DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
