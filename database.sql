CREATE DATABASE invoice_system;
USE invoice_system;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    address TEXT
);

CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_no VARCHAR(50),
    invoice_type ENUM('invoice','proforma'),
    customer_name VARCHAR(100),
    subtotal DECIMAL(10,2),
    tax DECIMAL(10,2),
    total DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE invoice_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT,
    item_name VARCHAR(100),
    qty INT,
    price DECIMAL(10,2),
    item_total DECIMAL(10,2),
    FOREIGN KEY (invoice_id) REFERENCES invoices(id)
);
