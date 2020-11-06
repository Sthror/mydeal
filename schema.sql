CREATE DATABASE mydeal CHARACTER SET utf8 COLLATE utf8_general_ci;
use mydeal;

CREATE TABLE `users` ( 
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `name` VARCHAR(32) NOT NULL, 
  `email` VARCHAR(32) NOT NULL UNIQUE, 
  `password` VARCHAR(60) NOT NULL
  );
CREATE TABLE category (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` char(60) NULL UNIQUE
);
CREATE TABLE task (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` char(128) NOT NULL,
  `date` DATE,
  `category_id` INT,
  `user_id` INT,
  `status` int NOT NULL,
  `file` char(128),
  FOREIGN KEY(`category_id`) REFERENCES category (id),
  FOREIGN KEY(`user_id`) REFERENCES users (id)
);