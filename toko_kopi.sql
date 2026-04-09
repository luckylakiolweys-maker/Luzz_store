CREATE DATABASE IF NOT EXISTS toko_kopi;
USE toko_kopi;

-- Tabel produk
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255)
);

INSERT INTO products (name, description, price, image) VALUES
('Espresso', 'Kopi hitam klasik', 15000, 'images/espresso.jpg'),
('Cappuccino', 'Kopi susu berbusa', 20000, 'images/cappuccino.jpg'),
('Latte', 'Kopi susu lembut', 22000, 'images/latte.jpg');

-- Tabel pesanan
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    email VARCHAR(100),
    address TEXT,
    total DECIMAL(10,2),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);