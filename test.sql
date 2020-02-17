-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.38 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test`;

-- Дамп структуры для таблица test.apple
DROP TABLE IF EXISTS `apple`;
CREATE TABLE IF NOT EXISTS `apple` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(10) NOT NULL DEFAULT '#008000',
  `creationDate` int(11) NOT NULL,
  `fallTime` int(11) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '5',
  `condition` tinyint(1) DEFAULT NULL,
  `size` tinyint(3) NOT NULL DEFAULT '100',
  `position` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.apple: ~16 rows (приблизительно)
DELETE FROM `apple`;
/*!40000 ALTER TABLE `apple` DISABLE KEYS */;
INSERT INTO `apple` (`id`, `color`, `creationDate`, `fallTime`, `status`, `condition`, `size`, `position`) VALUES
	(72, '#000000', 1119419523, NULL, 1, NULL, 100, 27),
	(73, '#000000', 1322918221, NULL, 1, NULL, 100, 15),
	(74, '#000000', 430849728, NULL, 1, NULL, 100, 5),
	(75, '#000000', 1306624957, NULL, 1, NULL, 100, 32),
	(76, '#000000', 165464576, NULL, 1, NULL, 100, 35),
	(77, '#000000', 545258990, NULL, 1, NULL, 100, 3),
	(78, '#000000', 1083350182, NULL, 1, NULL, 100, 13),
	(79, '#000000', 129283558, NULL, 1, NULL, 100, 24),
	(80, '#000000', 27637802, NULL, 1, NULL, 100, 36),
	(81, '#000000', 132027056, NULL, 1, NULL, 100, 34),
	(82, '#000000', 1122808505, NULL, 1, NULL, 100, 33),
	(83, '#000000', 1572761027, NULL, 1, NULL, 100, 14),
	(84, '#000000', 144526628, NULL, 1, NULL, 100, 12),
	(85, '#000000', 341803933, NULL, 1, NULL, 100, 22),
	(86, '#000000', 69151032, NULL, 1, NULL, 100, 4),
	(87, '#000000', 581052824, NULL, 1, NULL, 100, 23);
/*!40000 ALTER TABLE `apple` ENABLE KEYS */;

-- Дамп структуры для таблица test.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.migration: ~3 rows (приблизительно)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1581104999),
	('m130524_201442_init', 1581105018),
	('m190124_110200_add_verification_token_column_to_user_table', 1581105019);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица test.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` smallint(1) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы test.user: ~1 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `admin`) VALUES
	(1, 'andrey', '_TwmyWf6CvA-9xE1KDwz64BJa0-J8ZiA', '$2y$13$wJY18RCrUeN9PnEwR6wa2eFoDzj8SUrqNmP2vuNQZ5tj.x/2wkJay', NULL, 'greb.andrey84@gmail.com', 10, 1581142240, 1581143148, 'gyS-CXYrBvBGQVVvJOnzJ-fE3UfpVGWI_1581142240', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Дамп структуры базы данных test_test
CREATE DATABASE IF NOT EXISTS `test_test` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test_test`;

-- Дамп структуры для таблица test_test.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_test.migration: ~3 rows (приблизительно)
DELETE FROM `migration`;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1581111087),
	('m130524_201442_init', 1581111093),
	('m190124_110200_add_verification_token_column_to_user_table', 1581111093);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица test_test.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы test_test.user: ~0 rows (приблизительно)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
