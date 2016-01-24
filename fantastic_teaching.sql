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
(90,	'gnÃ¤llbÃ¤ltet',	'Svenska',	'3-5',	'2',	'dialektmysterier med Fredrik LindstrÃ¶m',	'',	'2016-01-23 18:06:43',	'R8skbVy4GVQ',	15),
(93,	'Pythagoras sats - INTRO',	'Matte',	'8-9',	'2',	'Pythagoras sats Ã¤r en av matematikens mest kÃ¤nda satser. Enligt Pythagoras sats sÃ¥ gÃ¤ller fÃ¶r en rÃ¤tvinklig triangels sidor att\r\n\r\nKvadraten pÃ¥ hypotenusan Ã¤r lika med summan av kvadraterna pÃ¥ kateterna.\r\nHypotenusan Ã¤r den lÃ¤ngsta sidan i en rÃ¤tvinklig triangel och Ã¤r motstÃ¥ende sida till den rÃ¤ta vinkeln. Katet Ã¤r benÃ¤mningen pÃ¥ var och en av de tvÃ¥ sidor vilka bildar den rÃ¤ta vinkeln.\r\n\r\nSambandet i Pythagoras sats kan skrivas som Pythagoras ekvation:\r\n\r\na^2 + b^2 = c^2\r\ndÃ¤r a, b och c Ã¤r sidornas lÃ¤ngder fÃ¶r en rÃ¤tvinklig triangel och c Ã¤r hypotenusans lÃ¤ngd.\r\n\r\nSatsens namn kommer frÃ¥n den grekiske matematikern Pythagoras (580 f.kr â€“ 495 f.kr) som brukar tillskrivas det fÃ¶rsta beviset fÃ¶r satsen, men satsen var fÃ¶rmodligen redan tidigare kÃ¤nd i Babylonien.\r\nCosinussatsen[redigera | redigera wikitext]\r\nPythagoras sats kan ses som ett specialfall av cosinussatsen, vilken gÃ¤ller fÃ¶r alla trianglar.\r\n\r\nLÃ¥t a, b och c vara sidolÃ¤ngderna hos en triangel och lÃ¥t Î¸ vara vinkeln mellan tvÃ¥ av sidorna, a och b. Sambandet mellan triangelns sidor och vinkeln Ã¤r dÃ¥\r\n\r\nc^2 = a^2 + b^2 - 2ab \\,\\cos\\theta\r\nOm vinkeln Î¸ Ã¤r lika med 90 grader Ã¤r cos Î¸ = 0 och Pythagoras sats fÃ¶ljer.\r\n\r\nEgyptiska trianglar och pythagoreiska tripler[redigera | redigera wikitext]\r\nEn egyptisk triangel Ã¤r en rÃ¤tvinklig triangel vars sidolÃ¤ngder fÃ¶rhÃ¥ller sig till varandra som talen 3, 4 och 5. FÃ¶r en sÃ¥dan triangel kan sidorna betecknas med 3n, 4n och 5n, dÃ¤r n Ã¤r ett positivt heltal. Enligt Pythagoras sats gÃ¤ller dÃ¥ att\r\n\r\n(3n)^2 + (4n)^2 = (5n)^2 \\Rightarrow 9 n^2 + 16 n^2 = 25 n^2\r\nvilket visar att satsen gÃ¤ller fÃ¶r alla egyptiska trianglar.\r\n\r\nTre positiva heltal, a, b och c, kallas fÃ¶r en pythagoreisk trippel (a,b,c), om a2 + b2 = c2. Enligt en formel angiven av Euklides kan talen i en pythagoreisk trippel bildas med hjÃ¤lp av uttrycken m2 - n2, 2mn och m2 + n2, dÃ¤r m och n Ã¤r positiva heltal och m > n enligt\r\n\r\n a = k\\cdot(m^2 - n^2)   ,\\ \\, b = k\\cdot(2mn) ,\\ \\, c = k\\cdot(m^2 + n^2)\r\ndÃ¤r k Ã¤r ett positivt heltal.\r\n\r\nExempel pÃ¥ pythagoreiska tripler som inte svarar mot egyptiska trianglar Ã¤r triplerna (5, 12, 13), (8, 15, 17) och (7, 24, 25).\r\n\r\nAv resultat ovan fÃ¶ljer ocksÃ¥ att det finns lika mÃ¥nga pythagoreiska tripler som det finns positiva heltal.',	'56a520c7ebb70.png',	'2016-01-24 19:06:47',	'uaj0XcLtN5c',	16),
(94,	'Oregelbundna verb',	'Svenska',	'3-5',	'2',	'Oregelbundna verb Ã¤r verb som inte fÃ¶ljer de regler som gÃ¤ller fÃ¶r regelbundna verb vid konjugation. Olika sprÃ¥k har olika regler.\r\n\r\nRegelbundenhet/oregelbundenhet hos verb avser hur verbet bÃ¶js nÃ¤r man tar tema pÃ¥ det, dvs man skriver det i infinitiv, imperfekt, supinum och presens particip . Exempel: arbeta - arbetade - arbetat.\r\n\r\nEtt regelbundet verbs grundform (till exempel arbeta, bÃ¶ja, mÃ¥) bÃ¶js genom en fÃ¶rutsÃ¤gbar regel. Man kan gruppera regelbundna verb i grupper som bÃ¶js pÃ¥ liknande sÃ¤tt. En sÃ¥dan grupp kallas konjugation. I svenskan har vi fyra konjugationer (dvs fyra grupper av regelbundna verb med sin respektive uppsÃ¤ttning regler). Exempel: den fÃ¶rsta konjugationen pÃ¥ svenska innebÃ¤r att man till grundformen lÃ¤gger -r, -de, -t:\r\n\r\nJag arbetar hela dagen.\r\nJag arbetade pÃ¥ X igÃ¥r.\r\nJag har arbetat hÃ¥rt.\r\nIbland tror man att tex springa Ã¤r oregelbundet (springa â€“ sprang â€“ sprungit) men det fÃ¶ljer faktiskt en regel och hÃ¶r till fjÃ¤rde konjugationen. FjÃ¤rde konjugationen utgÃ¶rs av s.k. starka verb:\r\n\r\nJag springer.\r\nJag sprang till X igÃ¥r.\r\nJag har sprungit.\r\nEtt oregelbundet verb (till exempel gÃ¥) fÃ¶ljer inte dessa regler och hÃ¶r dÃ¤rfÃ¶r inte till nÃ¥gon konjugation:\r\n\r\nJag gÃ¥r\r\nJag gick till X igÃ¥r.\r\nJag har gÃ¥tt.\r\nSe Ã¤ven[redigera | redigera wikitext]\r\nRegelbundet verb\r\nStarka verb\r\nSvaga verb',	'',	'2016-01-24 19:10:44',	'',	16),
(95,	'Gustav Vasa',	'Historia',	'3-5',	'2',	'Gustav Vasa eller Gustav I[1], sannolikt fÃ¶dd 12 maj 1496, dÃ¶d 29 september 1560[2], var kung av Sverige 1523â€“1560 och riksfÃ¶restÃ¥ndare 1521â€“1523, under det pÃ¥gÃ¥ende befrielsekriget. Hans makttilltrÃ¤de, inlett som ett uppror mot unionskungen Kristian II efter Stockholms blodbad innebar slutet fÃ¶r Kalmarunionen. Gustav tillhÃ¶rde VasaÃ¤tten, som genom honom blev den fÃ¶rsta monarkiska dynastin som regerade ett enat svenskt kungadÃ¶me som ett arvrike. Hans regering kÃ¤nnetecknas av infÃ¶randet av ett starkt centralstyre i hela riket med en effektiv byrÃ¥krati och en evangelisk statskyrka grundad pÃ¥ Luthers lÃ¤ra.\r\n\r\nGustavs roll i infÃ¶randet av en svensk arvmonarki ses i dag som grundandet av den moderna nationalstaten Sverige, och det Ã¤r den 6 juni â€“ datumet dÃ¥ han valdes till kung av riksdagen 1523 â€“ som Ã¤r Sveriges nationaldag. Han har senare, sÃ¤rskilt frÃ¥n det sena 1800-talet, upphÃ¶jts till landsfader och har dÃ¤rmed blivit en viktig nationell symbol. I modern historiesyn har Gustav I utsatts fÃ¶r en mer kritisk analys dÃ¤r man poÃ¤ngterat hur han med brutala metoder och intensiv propaganda befÃ¤ste sin makt och rÃ¶jde motstÃ¥ndare ur vÃ¤gen. Historikern Lars-Olof Larsson har pekat pÃ¥ att Gustav med hÃ¤nsynslÃ¶shet och maktlystnad i kombination med politisk skicklighet i mycket upptrÃ¤dde i enlighet med den italienske politiske filosofen NiccolÃ² Machiavellis principer fÃ¶r en furstes befÃ¤stande av sin makt, nÃ¥got som den svenska historieskrivningen ofta uteslutit.[3]',	'56a522291610e.jpg',	'2016-01-24 19:12:41',	'',	16),
(96,	'Stockholms blodbad',	'Historia',	'3-5',	'4',	'Stockholms blodbad var den rannsakning och efterfÃ¶ljande avrÃ¤ttningar som Ã¤gde rum i Stockholm den 7â€“9 november 1520. HÃ¤ndelserna inleddes direkt efter Kristian II:s (som efter blodbadet blev kÃ¤nd som Kristian Tyrann i Sverige[1]) krÃ¶ning till svensk kung nÃ¤r gÃ¤sterna pÃ¥ krÃ¶ningsfesten kallades till ett mÃ¶te pÃ¥ slottet. Ã„rkebiskop Gustav Trolles krav pÃ¥ ekonomisk kompensation fÃ¶r bland annat StÃ¤kets rivning ledde till frÃ¥gan om den tidigare riksfÃ¶restÃ¥ndaren Sten Sture den yngre och hans anhÃ¤ngare hade gjort sig skyldiga till kÃ¤tteri. Med stÃ¶d i kanonisk rÃ¤tt avrÃ¤ttades nÃ¤rmare 100 personer[2] de fÃ¶ljande dagarna. Bland de avrÃ¤ttade Ã¥terfanns mÃ¥nga inom aristokratin som hade givit sitt stÃ¶d Ã¥t Sturepartiet under de fÃ¶regÃ¥ende Ã¥ren.',	'56a52521289db.jpg',	'2016-01-24 19:25:21',	'',	16),
(97,	'infinity',	'Matte',	'8-9',	'2',	'Sometimes infinity is even bigger than you think... Dr James Grime explains with a little help from Georg Cantor.',	'',	'2016-01-24 20:47:12',	'elvOZm0d4H0',	15),
(98,	'arabic numerals',	'Matte',	'3-5',	'1',	'Hank unravels the fascinating yarn of how the world came to use so-called Arabic numerals -- from the scholarship of ancient Hindu mathematicians, to Muslim scientist Al-Khwarizmi, to the merchants of medieval Italy. \r\n',	'',	'2016-01-24 20:54:28',	'Ar7CNsJUm58',	15),
(99,	'Europas historia',	'Geografi',	'1-2',	'1',	'Denna artikel skildrar Europas historia.\r\n\r\nDe fÃ¶rsta fÃ¶r-mÃ¤nniskorna kom till Europa fÃ¶r cirka 800 000 Ã¥r sedan som ett resultat av att Homo erectus spred sig Ã¶ver jorden. Medan den moderna mÃ¤nniskan (Homo sapiens) fortfarande utvecklades i Afrika levde Homo heidelbergensis och Homo neanderthalensis (neandertalmÃ¤nniska) i Europa.\r\n\r\nDe fÃ¶rsta moderna mÃ¤nniskorna utvecklades i Afrika fÃ¶r omkring 200 000 Ã¥r sedan och kom till Europa fÃ¶r cirka 40 000 Ã¥r sedan.[1] Det var endast en liten grupp afrikaner som fÃ¶r kanske 60 000 Ã¥r sedan tog sig Ã¶ver till SinaihalvÃ¶n, och som blev fÃ¶rfÃ¤der till alla mÃ¤nniskor utom de svarta afrikaner som stannade i Afrika.[1][2] Forskarna tvistar Ã¤nnu om vÃ¤gen till Europa har gÃ¥tt direkt norrut genom det som idag Ã¤r Israel, Libanon och Syrien, eller om vÃ¥ra fÃ¶rfÃ¤der tog sig vidare Ã¶ver till Arabiska halvÃ¶n och sedan fÃ¶ljde Indiska oceanens kust tills de stÃ¶tte pÃ¥ floder som de fÃ¶ljde norrut. I bÃ¤gge fallen bÃ¶r Homo sapiens i sin fÃ¶rsta inflyttningsvÃ¥g till Europa fÃ¶r 40 000 Ã¥r sedan ha tagit sig till Europa via det som idag Ã¤r Anatolien (Turkiska halvÃ¶n), dÃ¤r mycket gamla fynd har hittats, och vidare Ã¶ver Bosporen.[3][1]\r\n\r\nAnsiktsbenen frÃ¥n den hittills Ã¤ldsta \"europÃ©n\" â€“ en 40 000 Ã¥r gamla fossil frÃ¥n en tonÃ¥ring â€“ har hittats i en grotta i RumÃ¤nien, och Richard Neave, brittisk kriminaltekniker har Ã¥terskapat ansiktet med hjÃ¤lp av kopior av skallbenen. En mÃ¶rkhyad, men inte svart, person med ansiktsdrag som inte Ã¶verensstÃ¤mmer helt med nÃ¥gon nu levande folkgrupp blev resultatet. (Den ljusa hudfÃ¤rgen antas ha utvecklats som ett resultat av mÃ¤nniskans behov av vitamin D.) Neave talar om ett ansikte som tycks befinna sig i \"flux\" â€“ i ett tillstÃ¥nd av fÃ¶rÃ¤ndring mot vilken som helst av de folkgrupper som idag finns i vÃ¤rlden.[4] Omkring tio procent av dagens europÃ©er bÃ¤r pÃ¥ gener frÃ¥n dessa fÃ¶rsta europÃ©er.[3] EuropÃ©erna Ã¤r dock ingen folkgrupp avskild frÃ¥n andra pÃ¥ jorden. Om vi moderna mÃ¤nniskor jÃ¤mfÃ¶r oss med varandra Ã¤r en person, vilken som helst, till 99,9 procent genetiskt identisk med en slumpvis utvald mÃ¤nniska var som helst pÃ¥ jorden. Enligt nya rÃ¶n bÃ¤r dessutom alla mÃ¤nniskor pÃ¥ jorden utom svarta afrikaner pÃ¥ en liten mÃ¤ngd genetiskt material som Ã¤r unikt fÃ¶r neandertalmÃ¤nniskan.[2]\r\n\r\nDe sista neandertalmÃ¤nniskorna dog ut fÃ¶r cirka 30 000 Ã¥r sedan. FÃ¶r cirka 25 000 Ã¥r sedan svepte vÃ¥gor av invandrare frÃ¥n Asien in i Europa, och kom att dominera kontinenten. Att likadana konstfÃ¶remÃ¥l hittats frÃ¥n dagens Frankrike till omrÃ¥det kring Kaspiska havet tyder pÃ¥ ett socialt nÃ¤tverk och mÃ¤nniskor med en Ã¶vergripande gemensam kultur.[3]',	'56a53a7521a94.png',	'2016-01-24 20:56:21',	'',	15);

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
(30,	'Teach some stuff',	'Historia',	'6-7',	12),
(31,	'LÃ¤ra ut lite andra saker',	'Geografi',	'1-2',	12),
(32,	'klass 5c vecka 7',	'Matte',	'1-2',	15),
(34,	'Addition',	'Matte',	'1-2',	9),
(35,	'Historia Ã¥r 3',	'Historia',	'3-5',	9),
(36,	'Historia Ã¥r 3',	'Historia',	'3-5',	16),
(37,	'Klass 3e vecka 13',	'Geografi',	'3-5',	15);

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
(54,	32,	89,	15),
(55,	NULL,	92,	NULL),
(56,	NULL,	90,	NULL),
(57,	34,	76,	9),
(58,	34,	77,	9),
(59,	35,	95,	9),
(60,	36,	95,	16),
(61,	36,	96,	16),
(62,	37,	96,	15),
(63,	37,	90,	15),
(64,	32,	99,	15);

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
(84,	76,	45,	15),
(85,	92,	1,	9),
(86,	90,	1,	9),
(87,	89,	-1,	9),
(88,	86,	1,	9),
(89,	84,	-1,	9),
(90,	95,	1,	9),
(91,	95,	1,	16),
(92,	96,	1,	15),
(93,	94,	1,	15),
(94,	99,	1,	15),
(95,	98,	1,	15),
(96,	97,	1,	15);

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
(15,	'eriklovenstad',	',pç‘ï@d¡U	;Åœà',	'0cfcd70bcfd5996709f271035d96a147a42ec1d5e43c34dd560c62f37ac5778e748a91d9dffeee23972dc109067b538ef710c958350aa54f6d44ca938eaa280c',	'Premium'),
(16,	'KlaraKollerstrom',	'À„¾)&^§ÕÝ¶!çŠ',	'07992091b2013fd2dcf8fae664814c861e0274619e70cb887a57499d08b8daec4c5bf9b827770da057896a55b0b9168940acb185df18b1bc2ed7bea04388a0b5',	'Premium');

-- 2016-01-24 20:58:24
