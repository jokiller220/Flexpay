CREATE DATABASE IF NOT EXISTS esgis_flexpay;
USE esgis_flexpay;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    flextag VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NULL,
    receiver_id INT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    transaction_type ENUM('deposit', 'withdrawal', 'p2p', 'purchase') NOT NULL,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_type ENUM('netflix', 'ecommerce', 'other') NOT NULL,
    product_url TEXT,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'purchased', 'delivered', 'cancelled') DEFAULT 'pending',
    account_credentials TEXT NULL, -- Pour Netflix/Spotify (JSON ou string chiffrée)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    tracking_number VARCHAR(100) NULL,
    carrier VARCHAR(100) NULL,
    current_status VARCHAR(100) DEFAULT 'Info Received',
    estimated_delivery DATE NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE IF NOT EXISTS virtual_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NULL,
    card_token VARCHAR(255) NOT NULL,
    last_four VARCHAR(4) NOT NULL,
    balance DECIMAL(10, 2) DEFAULT 0.00,
    status ENUM('active', 'used', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);
