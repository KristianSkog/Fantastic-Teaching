-- Adminer 4.2.2 MySQL dump

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
  `content_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `subject` enum('Matte','Svenska','Geografi','Historia') COLLATE utf8_bin NOT NULL,
  `year` enum('1-2','3-5','6-7','8-9') COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin NOT NULL,
  `file` varchar(50) COLLATE utf8_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video` varchar(150) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `content` (`content_id`, `title`, `subject`, `year`, `text`, `file`, `timestamp`, `video`) VALUES
(1,	'Min fina titel',	'Svenska',	'1-2',	'Svenska-text av Klara',	'',	'2016-01-04 18:30:18',	''),
(2,	'testar',	'Historia',	'3-5',	'historiatext',	'',	'2016-01-04 20:24:40',	''),
(12,	'Titel',	'Matte',	'6-7',	'Ny text om matte',	'',	'2016-01-04 20:24:47',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `salt` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`id`, `username`, `salt`, `password`) VALUES
(2,	'erik',	'ó>í?74þq„h{}?',	'0702eafd40f61cce7bbe8970bdfc9d453e3d9c76b610c33dc9d82937adefcc77399854d106b6d6222a2da6d8a2ef72d846234036ba1858ed5e409edd89a22afa'),
(3,	'Klara',	'M\ZGò9\nÄJözb_^',	'e8b2c16b8b40dca0a22f62a2794dbb8f038cea236079b6f4b874f8ed34748cacd82051cc4e67b87d365faa04345ea15702c620403a266dc0771ff217f611b03f'),
(4,	'kiss',	'|nîŽ8÷4¦ÂÛ;',	'9a9b95bcae1d4725ed531caa98c186f4602b06ad50864553958c70f63f316d90753802af01ad26fb5405dcd56b9ab63ace69f2771523c18a955db977ad9c0fb2');

-- 2016-01-05 11:30:19
