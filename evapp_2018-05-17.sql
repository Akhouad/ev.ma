# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: evapp
# Generation Time: 2018-05-17 12:47:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(7,'mwa','2018-04-03 11:06:48','2018-04-03 11:06:48'),
	(9,'web','2018-04-03 11:06:48','2018-04-03 11:06:48'),
	(14,'maroc','2018-04-03 13:36:32','2018-04-03 13:36:32'),
	(15,'awards','2018-04-03 13:36:32','2018-04-03 13:36:32'),
	(17,'timitar','2018-04-04 13:47:06','2018-04-04 13:47:06'),
	(18,'musiques','2018-04-04 13:47:06','2018-04-04 13:47:06'),
	(20,'musique','2018-04-04 14:57:55','2018-04-04 14:57:55'),
	(22,'2020','2018-04-04 15:16:47','2018-04-04 15:16:47'),
	(27,'musics','2018-04-05 12:01:35','2018-04-05 12:01:35'),
	(30,'tags','2018-04-05 12:04:34','2018-04-05 12:04:34'),
	(31,'john','2018-04-10 11:37:00','2018-04-10 11:37:00'),
	(32,'doe','2018-04-10 11:37:00','2018-04-10 11:37:00'),
	(34,'world','2018-04-13 11:36:40','2018-04-13 11:36:40'),
	(35,'cup','2018-04-13 11:36:40','2018-04-13 11:36:40'),
	(36,'football','2018-04-13 11:36:40','2018-04-13 11:36:40'),
	(37,'mawazine','2018-05-08 10:21:56','2018-05-08 10:21:56'),
	(38,'festival','2018-05-08 10:21:56','2018-05-08 10:21:56'),
	(39,'stars','2018-05-08 10:21:56','2018-05-08 10:21:56'),
	(40,'rabat','2018-05-08 10:21:56','2018-05-08 10:21:56'),
	(41,'2019','2018-05-08 10:21:56','2018-05-08 10:21:56'),
	(42,'casablanca','2018-05-08 10:29:16','2018-05-08 10:29:16'),
	(43,'nations unies','2018-05-08 10:29:16','2018-05-08 10:29:16'),
	(44,'sport','2018-05-08 13:06:49','2018-05-08 13:06:49'),
	(45,'coupe du monde','2018-05-08 13:06:49','2018-05-08 13:06:49'),
	(46,'morocco','2018-05-10 22:04:52','2018-05-10 22:04:52'),
	(47,'2026','2018-05-10 22:04:52','2018-05-10 22:04:52'),
	(48,'gnaoua','2018-05-11 09:58:35','2018-05-11 09:58:35'),
	(50,'sahara','2018-05-11 14:28:52','2018-05-11 14:28:52'),
	(51,'merzouga','2018-05-11 14:28:52','2018-05-11 14:28:52');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
