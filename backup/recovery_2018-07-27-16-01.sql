CREATE TABLE `club` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `name` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `club` VALUES('2', '123');
INSERT INTO `club` VALUES('3', '123');
INSERT INTO `club` VALUES('4', '123');
INSERT INTO `club` VALUES('5', '123');
INSERT INTO `club` VALUES('6', '123');
INSERT INTO `club` VALUES('7', '123');
CREATE TABLE `settings` (  `setting` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  PRIMARY KEY (`setting`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE `vorstand` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,  `bereiche` varchar(255) COLLATE utf8_unicode_ci NOT NULL,  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,  `telefon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,  PRIMARY KEY (`id`)) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `vorstand` VALUES('1', '234', '234', '234', '234');
INSERT INTO `vorstand` VALUES('2', '567', '567', '567', '567');
INSERT INTO `vorstand` VALUES('3', '435345', '345345', '345345', '345345');
