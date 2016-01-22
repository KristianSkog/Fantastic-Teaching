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
(4,	'8cf0d552d9620083dfc508138bb66355af53b75bab61ba08eefae22ef8b1507b49316793fdd08002163abefa7a30048a1e12d60015748f0f6b0bd9e6738dce43')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `email` = VALUES(`email`);

DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `subject` enum('Matte','Svenska','Geografi','Historia') COLLATE utf8_bin NOT NULL,
  `year` enum('1-2','3-5','6-7','8-9') COLLATE utf8_bin NOT NULL,
  `estimate` enum('1','2','3','4','5','6','7','8','9','10') COLLATE utf8_bin NOT NULL,
  `text` longtext COLLATE utf8_bin,
  `file` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `video` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `author_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `content` (`id`, `title`, `subject`, `year`, `estimate`, `text`, `file`, `timestamp`, `video`, `author_id`) VALUES
(51,	'SKÃ–Ã–Ã–Ã–Ã–N titel',	'Geografi',	'8-9',	'1',	'OskÃ¶n text',	'5697bb3002bd8.png',	'2016-01-14 15:13:52',	'Rn5HZKgZl7Y',	9),
(73,	'uiÃ¶irygkler',	'Svenska',	'1-2',	'1',	'',	'',	'2016-01-22 15:12:35',	'',	9)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `title` = VALUES(`title`), `subject` = VALUES(`subject`), `year` = VALUES(`year`), `estimate` = VALUES(`estimate`), `text` = VALUES(`text`), `file` = VALUES(`file`), `timestamp` = VALUES(`timestamp`), `video` = VALUES(`video`), `author_id` = VALUES(`author_id`);

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
(6,	'FÃ¶rsta mÃ¥let',	'Svenska',	'1-2',	9),
(8,	'',	'',	'',	0),
(9,	'Klaras mÃ¥l',	'Svenska',	'1-2',	0),
(10,	'',	'',	'',	0),
(11,	'',	'',	'',	0),
(12,	'',	'',	'',	0),
(13,	'',	'',	'',	0),
(14,	'',	'',	'',	0),
(15,	'',	'',	'',	0),
(16,	'',	'',	'',	0),
(17,	'',	'',	'',	0),
(18,	'',	'',	'',	0),
(19,	'',	'',	'',	0),
(20,	'',	'',	'',	0),
(22,	'',	'',	'',	0),
(23,	'',	'',	'',	0),
(24,	'',	'',	'',	0),
(25,	'',	'',	'',	0),
(26,	'',	'',	'',	0),
(27,	'kristians mÃ¥l',	'Svenska',	'1-2',	6),
(28,	'-jlnfew.m-hlkbgfer',	'Svenska',	'1-2',	9),
(29,	'lhgbkdlqÃ¶jwohia',	'Svenska',	'1-2',	9)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `goal` = VALUES(`goal`), `subject` = VALUES(`subject`), `year` = VALUES(`year`), `user_id` = VALUES(`user_id`);

DROP TABLE IF EXISTS `goals_use_content`;
CREATE TABLE `goals_use_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goal_id` int(10) unsigned DEFAULT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `goals_use_content` (`id`, `goal_id`, `content_id`, `user_id`) VALUES
(46,	6,	51,	9),
(47,	NULL,	51,	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `goal_id` = VALUES(`goal_id`), `content_id` = VALUES(`content_id`), `user_id` = VALUES(`user_id`);

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned NOT NULL,
  `rating` int(11) NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `rating` (`id`, `content_id`, `rating`, `users_id`) VALUES
(72,	51,	-1,	6)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `content_id` = VALUES(`content_id`), `rating` = VALUES(`rating`), `users_id` = VALUES(`users_id`);

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
(6,	'Kristian2',	'aqOj% qE¯¾MScz',	'd33d27aeea7524fb42a9ffb5149ce735cfcbb237d9f311798bae74009ff3eec5158effe8e7e7dbfa8239aeff6b218703c61941a4307d9a7a8a91e9b68dec1910',	'Premium'),
(8,	'KlaraFree',	'r?í‚õ½ÆFx€òÛÅä²Ø',	'42e7a1ab2732128ced176f98b4adff38c844efac9355a8a8bd3af8ccd394279681d8b72bacd4929338b57ba401027a748869dcc1f7e84f1927420fd0ba978dec',	'Free'),
(9,	'KlaraPremium',	'œ´+#¿’“Å	í»{˜‡',	'ad3ca7bd2d71f14b2a64807bab64c6b95af528647f4922ded3c36c2d088af37bd806e42e8a204452f0d871ce737626271e054626a62607dca3a81433564dad70',	'Premium'),
(10,	'KlarasKonto',	'N‹Ív´EüÄŽƒÅÉ‘LT',	'0c171666a9a94c04ab8eb9b9eecc60551e4ec646d76c6422e26e2466e41aaddee4835bd9c732fef00900d57ca764e8972f85be37e6fa8e99b65be88e45fa8241',	'Free')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `username` = VALUES(`username`), `salt` = VALUES(`salt`), `password` = VALUES(`password`), `level` = VALUES(`level`);

-- 2016-01-22 15:21:01
