CREATE DATABASE IF NOT EXISTS expense_manager;

USE expense_manager;

-- USERS TABLE

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- EXPENSE TABLE

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category VARCHAR(50),
    amount DECIMAL(10,2),
    expense_date DATE,
    notes TEXT,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
);

-- INCOME TABLE

CREATE TABLE income (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    source VARCHAR(100),
    amount DECIMAL(10,2),
    income_date DATE,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
);

-- USER PROFILE TABLE

CREATE TABLE user_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    profile_image VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
);

-- SAMPLE USER

INSERT INTO users(name,email,password)
VALUES(
'Lomesh Pawar',
'lomesh@gmail.com',
MD5('12345')
);

-- SAMPLE EXPENSE

INSERT INTO expenses(user_id,category,amount,expense_date,notes)
VALUES
(1,'Food',250,'2026-05-19','Lunch'),
(1,'Travel',500,'2026-05-19','Bus');

-- SAMPLE INCOME

INSERT INTO income(user_id,source,amount,income_date)
VALUES
(1,'Salary',25000,'2026-05-01');