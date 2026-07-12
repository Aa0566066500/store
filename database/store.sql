CREATE DATABASE IF NOT EXISTS store
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;


USE store;



-- جدول المستخدمين

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    phone VARCHAR(20) UNIQUE,

    email VARCHAR(100) UNIQUE,

    password VARCHAR(255) NOT NULL,

    otp_code VARCHAR(10) DEFAULT NULL,

    role VARCHAR(20) DEFAULT 'user',

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

    user_id INT NOT NULL,

    product_id INT NOT NULL,

    quantity INT DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(user_id)

    REFERENCES users(id)

    ON DELETE CASCADE,


    FOREIGN KEY(product_id)

    REFERENCES products(id)

    ON DELETE CASCADE

);



-- جدول الطلبات

CREATE TABLE orders (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    total DECIMAL(10,2) DEFAULT 0,

    status VARCHAR(50) DEFAULT 'جديد',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(user_id)

    REFERENCES users(id)

    ON DELETE CASCADE

);



-- تفاصيل الطلبات

CREATE TABLE order_items (

    id INT AUTO_INCREMENT PRIMARY KEY,

    order_id INT NOT NULL,

    product_id INT NOT NULL,

    quantity INT DEFAULT 1,

    price DECIMAL(10,2) DEFAULT 0,


    FOREIGN KEY(order_id)

    REFERENCES orders(id)

    ON DELETE CASCADE,


    FOREIGN KEY(product_id)

    REFERENCES products(id)

    ON DELETE CASCADE

);



-- جدول المفضلة

CREATE TABLE wishlist (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    product_id INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(user_id)

    REFERENCES users(id)

    ON DELETE CASCADE,


    FOREIGN KEY(product_id)

    REFERENCES products(id)

    ON DELETE CASCADE

);



-- جدول إعدادات المتجر

CREATE TABLE settings (

    id INT AUTO_INCREMENT PRIMARY KEY,

    store_name VARCHAR(100),

    phone VARCHAR(50),

    email VARCHAR(100),

    address TEXT

);



-- منتجات تجريبية

INSERT INTO products

(name, description, price, image, category, stock)

VALUES


(
'هاتف ذكي',
'هاتف بمواصفات عالية',
2999,
'phone.jpg',
'إلكترونيات',
10
),


(
'سماعات لاسلكية',
'صوت عالي الجودة',
499,
'airpods.jpg',
'إلكترونيات',
20
),


(
'ساعة ذكية',
'ساعة رياضية حديثة',
799,
'watch.jpg',
'إكسسوارات',
15
);



-- مستخدم مدير تجريبي

INSERT INTO users

(name, phone, email, password, role)

VALUES

(
'Admin',
'0500000000',
'admin@store.com',
'123456',
'admin'
);