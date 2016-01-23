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
(76,	'addition',	'Matte',	'1-2',	'4',	'Addition Ã¤r ett av de fyra grundlÃ¤ggande rÃ¤knesÃ¤tten inom aritmetiken. Addition betecknas oftast med plustecknet (+) som infÃ¶rdes omkring Ã¥r 1500, och Ã¤r en binÃ¤r operator. Addition av ett negativt tal Ã¤r ekvivalent med subtraktion.\r\n\r\nVid addition lÃ¤ggs vÃ¤rdet av tvÃ¥ (eller flera) termer samman till en summa. Att summan av sex och tvÃ¥ Ã¤r Ã¥tta skrivs 6+2=8 och utlÃ¤ses \"sex adderat med tvÃ¥ Ã¤r Ã¥tta\" eller \"sex plus tvÃ¥ Ã¤r Ã¥tta\".\r\n\r\nUpprepad addition betecknas med summatecken \\scriptstyle{\\sum}, ursprungligen den versala grekiska bokstaven Î£, sigma. Exempel:\r\n\r\n\\sum_{i=2}^{5} i = 2 + 3 + 4 + 5\r\nUpprepad addition med samma term motsvarar multiplikaton med ett heltal:\r\n\r\n\\sum_{i=1}^{n} x = x \\cdot n \r\nBegreppet addition och plusoperatorn anvÃ¤nds ocksÃ¥ fÃ¶r att beteckna andra binÃ¤ra operationer med liknande algebraiska egenskaper, exempelvis vektoraddition, matrisaddition, eller-operatorn i Boolesk algebra, modulÃ¤r addition, och konkatenering av textstrÃ¤ngar.\r\n\r\nSumman av tvÃ¥ naturliga tal a och b kan uppfattas som antalet objekt i den uppsÃ¤ttning som ges av att till en uppsÃ¤ttning med a objekt foga en uppsÃ¤ttning med b objekt. Addition av tal lyder under en kompositionsregel; tvÃ¥ element stÃ¤lls samman och resulterar i ett element. a och b stÃ¤lls samman och bildar exempelvis c. Vid addition av talet 0 till ett element a bibehÃ¥lls a ofÃ¶rÃ¤ndrat, a + 0 = a. Noll fÃ¶rÃ¤ndrar inte a:s vÃ¤rde vid addition, detta gÃ¤ller fÃ¶r varje tal a.[1]',	'',	'2016-01-23 17:38:33',	'',	15),
(77,	'ekvation',	'Matte',	'3-5',	'8',	'Inom matematiken Ã¤r uppstÃ¤llandet av en ekvation ett sÃ¤tt att med symboler beskriva, att de kvantitativa vÃ¤rdena av tvÃ¥ matematiska uttryck Ã¤r lika. Uttrycken, som kallas led, skiljs Ã¥t med ett likhetstecken. Det som stÃ¥r till vÃ¤nster kallas fÃ¶r vÃ¤nsterledet och det som stÃ¥r till hÃ¶ger fÃ¶r hÃ¶gerledet.\r\n\r\nEkvationer kan anvÃ¤ndas fÃ¶r att beskriva kÃ¤nda fÃ¶rhÃ¥llanden, till exempel fysikaliska eller ekonomiska sÃ¥dana. Att lÃ¶sa en ekvation Ã¤r att bestÃ¤mma de vÃ¤rden pÃ¥ ekvationens variabler fÃ¶r vilka ekvationen Ã¤r uppfylld.\r\n\r\nEn annan typ av matematiskt pÃ¥stÃ¥ende, Ã¤r olikheten.',	'',	'2016-01-23 17:39:44',	'',	15),
(78,	'subtraktion',	'Matte',	'1-2',	'4',	'Inom aritmetiken Ã¤r subtraktion ett av de fyra rÃ¤knesÃ¤tten. Vid subtraktion bildas differensen (skillnaden) mellan tvÃ¥ tal, termer. Differensen mellan talen a och b skrivs a âˆ’ b, dÃ¤r a kallas minuend och b kallas subtrahend, Ã¥tskilda av ett minustecken.[1]. Differensen Ã¤r positiv om a > b och negativ om a < b. Subtraktion Ã¤r omvÃ¤nd addition.',	'',	'2016-01-23 17:40:45',	'',	15),
(82,	'multiplikation',	'Matte',	'3-5',	'8',	'Multiplikation Ã¤r ett av de grundlÃ¤ggande rÃ¤knesÃ¤tten (operationerna) inom aritmetiken. Dess symbol Ã¤r multiplikationstecknet (Â·). De tal som multipliceras med varandra kallas faktorer och resultatet produkt. Multiplikation kan ses som upprepad addition eller som proportionalitet.',	'56a3bca2b3e0a.png',	'2016-01-23 17:47:14',	'',	15),
(84,	'primtal',	'Matte',	'1-2',	'6',	'Ett primtal Ã¤r ett heltal p, som Ã¤r stÃ¶rre Ã¤n 1 och som endast Ã¤r delbart med Â±1 och Â±p.\r\n\r\nDen grekiske matematikern Euklides visade pÃ¥ 300-talet f.Kr., med Euklides sats, att det finns ett oÃ¤ndligt antal primtal.',	'',	'2016-01-23 17:49:14',	'lEvXcTYqtKU',	15),
(85,	'afrika',	'Geografi',	'1-2',	'3',	'Afrika Ã¤r jordens nÃ¤st stÃ¶rsta kontinent (efter Eurasien) och Ã¤ven jordens nÃ¤st stÃ¶rsta vÃ¤rldsdel efter Asien, bÃ¥de vad gÃ¤ller areal och folkmÃ¤ngd. Med vÃ¤rldsdelens Ã¶ar inrÃ¤knade mÃ¤ter Afrika 30 244 050 kmÂ², vilket motsvarar 20,3 % av jordens landmassa eller cirka 6 % av jordens totala area. Omkring 22 miljoner kmÂ² av dessa ligger i tropikerna vilket gÃ¶r den afrikanska kontinenten till vÃ¤rldens varmaste kontinent. I Afrika bor det ungefÃ¤r 1 miljard mÃ¤nniskor i 55 lÃ¤nder â€“ en sjundedel av jordens befolkning. Dess lÃ¤ngd i nordlig-sydlig riktning Ã¤r omkring 8 000 km och dess stÃ¶rsta bredd omkring 7 800 km.\r\nlÃ¤nk: https://sv.wikipedia.org/wiki/Afrika',	'56a3bdb64e233.png',	'2016-01-23 17:51:50',	'',	15),
(86,	'asien',	'Geografi',	'1-2',	'4',	'Asien Ã¤r jordens stÃ¶rsta och mest folkrika vÃ¤rldsdel. Sedan 1700-talet har grÃ¤nsen mellan Europa och Asien vanligen ansetts gÃ¥ genom Uralbergen, Uralfloden, Kaspiska havet, Kaukasus, Svarta havet, Bosporen, MarmarasjÃ¶n och Dardanellerna. GrÃ¤nsen mellan Asien och Afrika anses normalt vara SueznÃ¤set och RÃ¶da havet. Omkring 60 % av vÃ¤rldens befolkning bor i Asien, varav enbart kring 2 % bor i norra och innersta delen, det vill sÃ¤ga Mongoliet, de centralasiatiska lÃ¤nderna Kazakstan, Uzbekistan, Turkmenistan, Kirgizistan och Tadzjikistan, de kinesiska provinserna Xinjiang, Tibet, Qinghai och ryska Sibirien.\r\n\r\nDÃ¥ vÃ¤rldsdelar delvis definieras genom kulturgeografi, det vill sÃ¤ga pÃ¥ grundval av kulturell samhÃ¶righet, och inte genom geologi, rÃ¥der det en skillnad mellan Asien som vÃ¤rldsdel och som geografisk kontinent. Asien och Europa befinner sig pÃ¥ samma kontinent och denna heter Eurasien. VÃ¤rldsdelen Asien omfattar en del av den Eurasiatiska kontinenten, nÃ¤rmare bestÃ¤mt ett omrÃ¥de frÃ¥n SinaihalvÃ¶n, Turkiet och Uralbergen i vÃ¤ster till Berings Sund, Japan, Taiwan, Filippinerna och Indonesien i Ã¶ster.\r\n\r\nIdÃ©n om att den gamla vÃ¤rlden har tre kontinenter gÃ¥r tillbaka till antiken. Namnet Asien hÃ¤rleds frÃ¥n de urÃ¥ldriga civilisationerna i MellanÃ¶stern. Asien var under Romarriket benÃ¤mning pÃ¥ en romersk provins som lÃ¥g i dagens Turkiet. Betydelsen fÃ¶r namnet Asien har senare kommit att utstrÃ¤ckas till att omfatta hela omrÃ¥det frÃ¥n SinaihalvÃ¶n, Turkiet och Uralbergen i vÃ¤ster till Berings sund, Japan, Taiwan, Filippinerna och Indonesien i Ã¶ster.',	'56a3beea6f90f.png',	'2016-01-23 17:56:58',	'',	15),
(89,	'dalmÃ¥l',	'Svenska',	'6-7',	'1',	'dialektmysterier med fredrik lindstrÃ¶m',	'',	'2016-01-23 18:05:29',	'V1YqXOSoDmc',	15),
(90,	'gnÃ¤llbÃ¤ltet',	'Svenska',	'3-5',	'2',	'dialektmysterier med Fredrik LindstrÃ¶m',	'',	'2016-01-23 18:06:43',	'R8skbVy4GVQ',	15);

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
(29,	'lhgbkdlqÃ¶jwohia',	'Svenska',	'1-2',	9),
(30,	'Teach some stuff',	'Historia',	'6-7',	12),
(31,	'LÃ¤ra ut lite andra saker',	'Geografi',	'1-2',	12),
(32,	'klass 5c vecka 7',	'Matte',	'1-2',	15);

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
(47,	NULL,	51,	NULL),
(48,	NULL,	51,	NULL),
(49,	NULL,	75,	NULL),
(50,	30,	75,	12),
(51,	32,	84,	15),
(52,	32,	82,	15),
(53,	32,	78,	15),
(54,	32,	89,	15);

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
(76,	90,	23,	15),
(77,	89,	13,	15),
(78,	86,	100,	15),
(79,	85,	56,	15),
(80,	84,	7,	15),
(81,	82,	89,	15),
(82,	78,	5,	15),
(83,	77,	23,	15),
(84,	76,	45,	15);

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
(10,	'KlarasKonto',	'N‹Ív´EüÄŽƒÅÉ‘LT',	'0c171666a9a94c04ab8eb9b9eecc60551e4ec646d76c6422e26e2466e41aaddee4835bd9c732fef00900d57ca764e8972f85be37e6fa8e99b65be88e45fa8241',	'Free'),
(15,	'eriklovenstad',	',pç‘ï@d¡U	;Åœà',	'0cfcd70bcfd5996709f271035d96a147a42ec1d5e43c34dd560c62f37ac5778e748a91d9dffeee23972dc109067b538ef710c958350aa54f6d44ca938eaa280c',	'Premium');

-- 2016-01-23 18:12:49
