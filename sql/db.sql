-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.30-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2017-04-19 18:10:47
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for bib
CREATE DATABASE IF NOT EXISTS `bib` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bib`;


-- Dumping structure for table bib.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table bib.authors: ~5 rows (approximately)
DELETE FROM `authors`;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `firstname`, `lastname`) VALUES
	(1, 'Александр', 'Пушкин'),
	(2, 'Михаил', 'Лермонтов'),
	(3, 'Николай', 'Гоголь'),
	(4, 'Джек', 'Лондон'),
	(5, 'Эрнест', 'Хемингуэй'),
	(6, 'asfwsdf', 'sdfasdf');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Dumping structure for table bib.books
DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table bib.books: ~7 rows (approximately)
DELETE FROM `books`;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `title`) VALUES
	(1, 'test'),
	(2, 'test2'),
	(3, 'test3'),
	(4, 'sdfsdf'),
	(5, 'asdad'),
	(6, 'sdfsdf'),
	(7, 'werwerer'),
	(14, 'sfdfdfsdf'),
	(15, '');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;


-- Dumping structure for table bib.books_authors
DROP TABLE IF EXISTS `books_authors`;
CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_id`,`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table bib.books_authors: ~9 rows (approximately)
DELETE FROM `books_authors`;
/*!40000 ALTER TABLE `books_authors` DISABLE KEYS */;
INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 2),
	(2, 3),
	(3, 1),
	(4, 4),
	(5, 5);
/*!40000 ALTER TABLE `books_authors` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
