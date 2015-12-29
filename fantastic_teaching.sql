-- Adminer 4.2.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `content` (
  `content_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin NOT NULL,
  `subject` enum('Matte','Svenska','Geografi','Historia') COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `content` (`content_id`, `title`, `text`, `subject`) VALUES
(2,	'Lite content',	'Och en massa text',	'Svenska'),
(6,	'titel',	'text',	'Geografi'),
(7,	'test frÃ¥n Klara',	'lÃ¥ng text					\r\n				',	'Historia'),
(8,	'Nytt test av Klara',	'Min senaste text					\r\n				',	'Matte'),
(18,	'Matte-test',	'Matte-frÃ¥gor 1 2 3 4',	'Matte'),
(19,	'svenska-test',	'svenska test',	'Svenska');

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1,	'admin',	'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

-- 2015-12-29 21:10:33
