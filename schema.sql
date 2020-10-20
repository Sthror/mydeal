CREATE DATABASE `mydeal` COLLATE 'utf8_unicode_ci';
use mydeal;
CREATE TABLE `users` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` char(32) NOT NULL,
  `password` varchar(32) NOT NULL
);
CREATE TABLE `category` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` char(32) NOT NULL UNIQUE
);
CREATE TABLE `task` (
  `id` int AUTO_INCREMENT PRIMARY KEY,
  `name` char(128) NOT NULL,
  `date` DATE,
  `category_id` INT,
  `user_id` INT,
  `status` int NOT NULL 
);