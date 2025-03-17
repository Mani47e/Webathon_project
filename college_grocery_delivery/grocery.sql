-- Drop existing database (optional for fresh start)
DROP DATABASE IF EXISTS college_grocery_delivery;

-- Create new database
CREATE DATABASE college_grocery_delivery;
USE college_grocery_delivery;

-- STUDENTS Table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address TEXT,
    phone VARCHAR(15)
);

-- SELLERS Table
CREATE TABLE sellers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address TEXT,
    phone VARCHAR(15),
    operating_hours VARCHAR(100)
);

-- PRODUCTS Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    image VARCHAR(255),
    FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE CASCADE
);

-- CART Table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ORDERS Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    delivery_slot VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

-- ORDER_ITEMS Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- PROMOTIONS Table
CREATE TABLE promotions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    title VARCHAR(100),
    discount_percent INT DEFAULT 0,
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE CASCADE
);

-- TRANSACTION_HISTORY Table
CREATE TABLE transaction_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    order_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES sellers(id) ON DELETE CASCADE,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- INSERT SAMPLE SELLERS
INSERT INTO sellers (name, email, password, address, phone, operating_hours)
VALUES ('Radhika Supermarket', 'radhika@example.com', MD5('12345'), 'College Road', '9876543210', '9AM - 9PM');

-- INSERT SAMPLE PRODUCTS
INSERT INTO products (seller_id, name, description, price, stock, image)
VALUES 
(1, 'Maggi Noodles', '2-Minute Instant Noodles', 12.00, 100, 'maggie.jpg'),
(1, 'Dairy Milk Chocolate', 'Milk Chocolate Bar', 25.00, 50, 'dairy_milk.jpg'),
(1, 'Parle-G Biscuits', 'Classic Glucose Biscuits', 10.00, 75, 'parle_g.jpg');
