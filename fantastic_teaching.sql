-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `fantastic_teaching`;
CREATE DATABASE `fantastic_teaching` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `fantastic_teaching`;

DROP TABLE IF EXISTS `allowed_accounts`;
CREATE TABLE `allowed_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `allowed_accounts` (`id`, `email`) VALUES
(1,	'd805ddd4cd620561635b001020373b3fe7945e9ab116e0701a6ec02b0b39203cc47cee927c4c5a336a1a3050980cb99bbb32bd7ace31c55e23c3486f3059b1d7'),
(2,	'f638b0dd412a7de0fc17612db3271543e48a74070ff31312444e621c2c0160d1bdfbb5e511126c83eccf1534dd5567e4232b6e3c936fb53355a8eae47d6738e4'),
(3,	'b8cba57da356b0f18e7245cee154e6f1a5182e26e5eaee5b8b3cb1eb990219b135c9663f8f32c2c03938ed6afb63233bf530914edf1b10ceb60e1894c765663a'),
(4,	'8cf0d552d9620083dfc508138bb66355af53b75bab61ba08eefae22ef8b1507b49316793fdd08002163abefa7a30048a1e12d60015748f0f6b0bd9e6738dce43');

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `subject` enum('Matte','Svenska','Geografi','Historia') COLLATE utf8_bin NOT NULL,
  `year` enum('1-2','3-5','6-7','8-9') COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin,
  `file` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `author_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `content` (`id`, `title`, `subject`, `year`, `text`, `file`, `timestamp`, `video`, `author_id`) VALUES
(46,	'innehÃ¥llets titel',	'Svenska',	'1-2',	'min jÃ¤vla text',	'',	'2016-01-07 19:34:54',	'',	3),
(47,	'titeln',	'Svenska',	'1-2',	'textfan',	'',	'2016-01-07 20:37:04',	'',	3),
(48,	'Nytt innehÃ¥ll av premiumkonto',	'Svenska',	'1-2',	'premiumkonto',	'',	'2016-01-11 16:58:05',	'',	9);


DROP TABLE IF EXISTS `goals`;
CREATE TABLE `goals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goal` varchar(150) COLLATE utf8_bin NOT NULL,
  `subject` enum('Matte','Svenska','Geografi','Historia') COLLATE utf8_bin NOT NULL,
  `year` enum('1-2','3-5','6-7','8-9') COLLATE utf8_bin NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `goals` (`id`, `goal`, `subject`, `year`, `user_id`) VALUES
(2,	'Nytt mÃ¥l',	'Historia',	'6-7',	3),
(4,	'tredje',	'Svenska',	'1-2',	3),
(5,	'hej pÃ¥ dig ERIK',	'Svenska',	'1-2',	6);

DROP TABLE IF EXISTS `goals_use_content`;
CREATE TABLE `goals_use_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goal_id` int(10) unsigned NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `goals_use_content` (`id`, `goal_id`, `content_id`, `user_id`) VALUES
(1,	4,	46,	3),
(4,	2,	46,	3),
(5,	2,	46,	3),
(6,	2,	46,	3),
(7,	2,	46,	3),
(8,	2,	46,	3),
(9,	2,	46,	3),
(10,	2,	46,	3),
(11,	2,	46,	3),
(12,	2,	46,	3),
(13,	3,	47,	3),
(14,	4,	47,	3),
(15,	5,	47,	6);

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `rating` (`id`, `content_id`, `rating`, `users_id`) VALUES
(19,	47,	-1,	6),
(20,	46,	1,	6),
(21,	46,	1,	6),
(22,	46,	1,	6),
(23,	46,	1,	6),
(24,	47,	1,	6),
(25,	47,	1,	6),
(26,	47,	1,	6),
(27,	47,	-1,	6),
(28,	47,	-1,	6),
(29,	47,	-1,	6),
(30,	47,	-1,	6),
(31,	47,	-1,	6),
(32,	47,	-1,	6),
(33,	47,	-1,	6),
(34,	47,	-1,	6),
(35,	47,	1,	6),
(36,	47,	1,	6),
(37,	46,	1,	6),
(38,	46,	1,	6),
(39,	46,	1,	6),
(40,	46,	1,	6),
(41,	46,	1,	6),
(42,	46,	1,	6),
(43,	46,	1,	6),
(44,	46,	1,	6),
(45,	46,	1,	6),
(46,	46,	1,	6),
(47,	46,	1,	6),
(48,	46,	1,	6),
(49,	46,	1,	6),
(50,	46,	1,	6),
(51,	46,	1,	6),
(52,	46,	1,	6),
(53,	46,	1,	6),
(54,	46,	1,	6),
(55,	46,	1,	6),
(56,	46,	1,	6),
(57,	46,	1,	6),
(58,	46,	-1,	6),
(59,	46,	-1,	6),
(60,	46,	-1,	6),
(61,	46,	-1,	6),
(62,	47,	1,	6),
(63,	47,	1,	6);

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `rating` (`id`, `content_id`, `rating`, `users_id`) VALUES
(19,	47,	-1,	6),
(20,	46,	1,	6),
(21,	46,	1,	6),
(22,	46,	1,	6),
(23,	46,	1,	6),
(24,	47,	1,	6),
(25,	47,	1,	6),
(26,	47,	1,	6),
(27,	47,	-1,	6),
(28,	47,	-1,	6),
(29,	47,	-1,	6),
(30,	47,	-1,	6),
(31,	47,	-1,	6),
(32,	47,	-1,	6),
(33,	47,	-1,	6),
(34,	47,	-1,	6),
(35,	47,	1,	6),
(36,	47,	1,	6),
(37,	46,	1,	6),
(38,	46,	1,	6),
(39,	46,	1,	6),
(40,	46,	1,	6),
(41,	46,	1,	6),
(42,	46,	1,	6),
(43,	46,	1,	6),
(44,	46,	1,	6),
(45,	46,	1,	6);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `salt` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  `level` enum('Free','Premium') COLLATE utf8_bin NOT NULL DEFAULT 'Free',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `username`, `salt`, `password`, `level`) VALUES
(4,	'kiss',	'|nîŽ8÷4¦ÂÛ;',	'9a9b95bcae1d4725ed531caa98c186f4602b06ad50864553958c70f63f316d90753802af01ad26fb5405dcd56b9ab63ace69f2771523c18a955db977ad9c0fb2',	'Premium'),
(6,	'Kristian2',	'aqOj% qE¯¾MScz',	'd33d27aeea7524fb42a9ffb5149ce735cfcbb237d9f311798bae74009ff3eec5158effe8e7e7dbfa8239aeff6b218703c61941a4307d9a7a8a91e9b68dec1910',	'Premium'),
(8,	'KlaraFree',	'r?í‚õ½ÆFx€òÛÅä²Ø',	'42e7a1ab2732128ced176f98b4adff38c844efac9355a8a8bd3af8ccd394279681d8b72bacd4929338b57ba401027a748869dcc1f7e84f1927420fd0ba978dec',	'Free'),
(9,	'KlaraPremium',	'Ïô®WQGøêezVá÷Ç®',	'04f071db62fa07a106ec8af876ae0e9416de6e0a3b53aff9a9b4b3aff9416439d415e47506da98b9a8d306d3115e731f821721cbbf3fe5d1fb2cf87b8dd8d2fe',	'Premium');
