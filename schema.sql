CREATE DATABASE `yeticave`
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

USE `yeticave`;
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `regdate` DATETIME,
  `email` char(120),
  `name` char(120),
  `password` char(120),
  `avatar` char(120),
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
  `dateadd` DATETIME,
  `lotname` char(120),
  `lotdesc` text(120),
  `imgurl` char(120),
  `firstprice` int (60),
  `enddate` TIMESTAMP ,
  `bidstep` int(60)
);

CREATE TABLE `bids` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `bidate` DATETIME,
  `offer` int(60),
  `user_id` int(120),
  `lot_id` int(120)
);

CREATE UNIQUE INDEX email ON `users` (`email`);
CREATE INDEX lot ON `lot`(`lotname`);
CREATE INDEX offer ON `bids`(`offer`);
