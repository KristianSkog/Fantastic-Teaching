-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fantastic_teaching`;
CREATE DATABASE `fantastic_teaching` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `fantastic_teaching`;

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin NOT NULL,
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `content` (`title`, `text`, `content_id`) VALUES
('Test',	'Det här är en jättelång text',	1),
('Lite content',	'Och en massa text',	2),
('1',	'2',	3),
('1',	'2',	4),
('titel',	'text\r\n',	5),
('titel',	'text',	6);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1,	'erik',	'123');

-- 2015-12-23 11:05:35
