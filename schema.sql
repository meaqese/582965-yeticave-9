CREATE DATABASE `yeticave`
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

USE `yeticave`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `regdate` DATETIME,
  `email` char(120),
  `name` char(120),
  `password` char,
  `avatar` char,
  `contacts` char(120)
);

CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` CHAR(120),
  `signcode` CHAR (60)
);

CREATE TABLE `lot` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `author_id` int(120),
  `winner_id` int(120),
  `category_id` int(120),
  `datedd` DATETIME,
  `lotname` char(120),
  `lotdesc` text,
  `imgurl` char,
  `firstprice` int (60),
  `enddate` DATETIME,
  `bidstep` int
);

CREATE TABLE `bids` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `bidate` DATETIME,
  `offer` int,
  `user_id` int(120),
  `lot_id` int(120)
);

CREATE UNIQUE INDEX email ON `users` (`email`);
CREATE INDEX lot ON `lot`(`lotname`);
CREATE INDEX offer ON `bids`(`offer`);
