DROP DATABASE IF EXISTS authentication;
CREATE DATABASE authentication;
USE authentication;

CREATE TABLE users (
user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(20),
last_name VARCHAR(20),
email VARCHAR(50) UNIQUE,
password_salt CHAR(64),
salt CHAR(12)
);

