-- Adminer 4.8.1 MySQL 8.0.34-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `ArticleDB` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ArticleDB`;

DROP TABLE IF EXISTS `Article`;
CREATE TABLE `Article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Article_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `Article` (`id`, `title`, `content`, `image`) VALUES
(9,	'Ромашка',	'Ромашка - цветок',	'images/repey.jpg'),
(10,	'Репей',	'Репей - цветок',	'images/repey.jpg'),
(11,	'Иван-чай',	'Иван-чай - цветок',	'images/repey.jpg'),
(12,	'134',	'mister twister',	'images/repey.jpg');

-- 2023-11-30 05:29:58
