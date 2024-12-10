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
