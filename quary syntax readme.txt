-- Create the "hsms_db" database if it doesn't exist
CREATE DATABASE IF NOT EXISTS hsms_db;

-- Switch to the "hsms_db" database
USE hsms_db;

-- Create a table for user registration
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    PASSWORD VARCHAR(255) NOT NULL,
    user_type ENUM('1', '2', '3') NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
