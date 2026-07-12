CREATE DATABASE IF NOT EXISTS store;

USE store;


-- جدول المستخدمين

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    phone VARCHAR(20) UNIQUE,

    email VARCHAR(100) UNIQUE,

    password VARCHAR(255),

    otp_code VARCHAR(10),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);



-- جدول المنتجات

CREATE TABLE products (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(200) NOT NULL,

    description TEXT,

    price DECIMAL(10,2) NOT NULL,

    image VARCHAR(255),

    category VARCHAR(100),

    stock INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);



-- جدول السلة

CREATE TABLE cart (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    product_id INT,

    quantity INT DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id) REFERENCES users(id)
    ON DELETE CASCADE,

    FOREIGN KEY(product_id) REFERENCES products(id)
    ON DELETE CASCADE

);



-- جدول الطلبات

CREATE TABLE orders (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT,

    total DECIMAL(10,2),

    status VARCHAR(50) DEFAULT 'جديد',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(user_id) REFERENCES users(id)
    ON DELETE CASCADE

);



-- جدول تفاصيل الطلب

CREATE TABLE order_items (

    id INT AUTO_INCREMENT PRIMARY KEY,

    order_id INT,

    product_id INT,

    quantity INT,

    price DECIMAL(10,2),

    FOREIGN KEY(order_id) REFERENCES orders(id)
    ON DELETE CASCADE,

    FOREIGN KEY(product_id) REFERENCES products(id)
    ON DELETE CASCADE

);



-- إضافة منتجات تجريبية

INSERT INTO products 
(name, description, price, image, category, stock)

VALUES

(
"هاتف ذكي",
"هاتف بمواصفات عالية",
2999,
"phone.jpg",
"إلكترونيات",
10
),

(
"سماعات لاسلكية",
"صوت عالي الجودة",
499,
"airpods.jpg",
"إلكترونيات",
20
);