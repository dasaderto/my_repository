-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.19 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных library
CREATE DATABASE IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `library`;

-- Дамп структуры для таблица library.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `class` varchar(100) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `about` text NOT NULL,
  `file` varchar(100) NOT NULL,
  `filesize` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.books: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `name`, `author`, `category`, `date`, `class`, `img`, `about`, `file`, `filesize`) VALUES
	(1, 'Книга1', 'Авторист', 1, '2018-04-04', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ReferenceCard.pdf', 32000),
	(2, 'Книга2', 'Авторист', 2, '2018-04-04', '11 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ReferenceCard.pdf', 32000),
	(3, 'Книга3', 'Авторист', 1, '2018-04-04', 'Прочее', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ReferenceCard.pdf', 32000),
	(4, 'Книга4', 'Никита', 2, '2018-04-04', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ReferenceCard.pdf', 32000),
	(5, 'Книга5', 'Никита', 6, '2018-04-04', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ReferenceCard.pdf', 32000),
	(6, 'Enjoy English', 'Биболетова М.З.', 5, '2018-05-26', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'v229_zanyatie.doc', 11702272),
	(7, 'Enjoy English', 'Авторист', 2, '2018-05-26', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'e5me.pdf', 73989),
	(8, 'Enjoy English', 'Авторист', 1, '2018-05-27', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'h10me.pdf', 73989),
	(9, 'Веселый Английский', 'Авторист', 8, '2018-05-27', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'e37me.pdf', 73989),
	(10, 'Веселый Английский', 'tester', 8, '2018-05-27', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'm49me.pdf', 73989),
	(11, 'Enjoy English', 'Никита', 7, '2018-05-27', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'n9me.pdf', 73989),
	(12, 'Enjoy English', 'Авторист', 9, '2018-05-27', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'r26me.pdf', 73989),
	(13, 'Досвидос', 'Никита Есипович', 12, '2018-06-07', '10 класс', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 'ys37rukovod.doc', 303104),
	(14, 'Веселый Английскийs', 'Авывыв ы ', 1, '2018-06-11', '10 класс', NULL, '', 'pu23Titulyniki.docx', 16817);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;

-- Дамп структуры для таблица library.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.category: ~11 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `category`, `rank`) VALUES
	(1, 'Иностранный язык', 1),
	(2, 'Информатика', 1),
	(3, 'Книги по КИП и А', 1),
	(4, 'Программирование', 1),
	(5, 'Методические указания', 2),
	(6, 'test', 1),
	(7, 'Романы', 1),
	(8, 'Моя Категория', 1),
	(9, 'Мюзикл', 1),
	(10, 'My Category', 1),
	(12, 'Новый Мир', 1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица library.students
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `quantity` int(12) NOT NULL DEFAULT '0',
  `date` year(4) DEFAULT '2018',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.students: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`id`, `quantity`, `date`) VALUES
	(1, 188, '2018'),
	(2, 171, '2018'),
	(3, 51, '2018'),
	(4, 72, '2018');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Дамп структуры для таблица library.techniques
CREATE TABLE IF NOT EXISTS `techniques` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `class` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `category` int(12) NOT NULL,
  `date` date NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `about` text,
  `filesize` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  CONSTRAINT `techniques_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.techniques: ~19 rows (приблизительно)
/*!40000 ALTER TABLE `techniques` DISABLE KEYS */;
INSERT INTO `techniques` (`id`, `name`, `author`, `class`, `file`, `category`, `date`, `img`, `about`, `filesize`) VALUES
	(1, 'Книга 1', 'Борис', '10 класс', 'ys44rukovod.doc', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(2, 'Книга 2', 'Борис', '10 класс', 'ReferenceCard.pdf', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(3, 'Книга 3', 'Автор 2', '10 класс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(4, 'Книга 4', 'Автор 2', '11 класс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(5, 'Книга 5', 'Автор 2', '11 класс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(6, 'testbook5', 'tester', '11 класс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 6, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(7, 'testbook3', 'Никита', '1 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 6, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(8, 'testbook1', 'tester', '1 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 6, '2005-09-18', 'v22Dokument2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 3123226),
	(9, 'Методические указания по английскому языку', 'Стеблева И.В.', '1 курс', 'h8METODIChKA_dlya_programmistov.docx', 5, '2018-05-21', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 107199),
	(10, 'Методические', 'Стеблева И.В.', '2 курс', 'h8METODIChKA_dlya_programmistov.docx', 2, '2018-05-21', '', 'Главное внимание уделено формированию навыков устной речи на английском языке по темам: виды компьютеров, устройство компьютера, компьютерное аппаратное и программное обеспечение, интернет.\r\nМетодические указания состоят из 10 уроков, снабжены послетекстовыми лексическими и грамматическими упражнениями. Предлагаются различные коммуникативные ситуации для развития навыков диалогической и монологической речи.', 107199),
	(11, 'Заключающий аккорд', 'Никита Есипович', '2 курс', 'cj42Elektronnaya_biblioteka.docx', 12, '2018-05-30', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 14167),
	(12, 'Книга 6', 'Борис', '2 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(13, 'Книга 7', 'Борис', '3 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(14, 'Книга 8', 'Борис', '3 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(15, 'Книга 9', 'Борис', '3 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(16, 'Книга 10', 'Борис', '4 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(17, 'Книга 11', 'Борис', '4 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(18, 'Книга 12', 'Борис', '4 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 5, '2018-03-23', 'book1.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000),
	(19, 'testbook4', 'tester', '4 курс', 'k11HARAKTERISTIKA_PREDPRIYaTIYa.docx', 6, '2018-03-22', 'Book2.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur vitae enim asperiores omnis placeat optio sit! Temporibus, molestiae, fuga saepe mollitia sequi fugiat laudantium ea magni at rem excepturi ex?', 32000);
/*!40000 ALTER TABLE `techniques` ENABLE KEYS */;

-- Дамп структуры для таблица library.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.users: ~18 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
	(1, 'Marinka', '53506ae819a59f397b970e6fe5e9dbea', 2),
	(2, 'myAdmin', '21232f297a57a5a743894a0e4a801fc3', 3),
	(3, 'admin123', '0192023a7bbd73250516f069df18b500', 1),
	(4, 'kostyukova', '5f4dcc3b5aa765d61d8327deb882cf99', 2),
	(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3),
	(6, 'adminsss', '21232f297a57a5a743894a0e4a801fc3', 1),
	(7, 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 1),
	(8, 'resultresult', '937d4dd628a8858b443a399410d2600b', 1),
	(9, 'resultresultresult', '937d4dd628a8858b443a399410d2600b', 1),
	(10, 'adminadminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 1),
	(11, 'adminadminadminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 1),
	(12, 'dddddd', '55bf2dade25e6e1d5bb8590fee82d254', 1),
	(13, 'ss12wq', 'faf08bafc9ff654e5a3afa8dbdc5e47c', 1),
	(14, 'rakal', 'c715c6fb62fb284bd4bdc42e079624ba', 1),
	(15, 'adminss1', '1b718ce1205c5326fde43e334b5eae26', 1),
	(16, 'adminsadmins', '1df07bcb21e91dd29ac01c91680ea349', 1),
	(17, 'adminsadmins', '1df07bcb21e91dd29ac01c91680ea349', 1),
	(23, 'dafaer', 'c427c79b5e78585d4683d8a4bbd21b35', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Дамп структуры для таблица library.workbooks
CREATE TABLE IF NOT EXISTS `workbooks` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) DEFAULT NULL,
  `publishing` varchar(255) DEFAULT NULL,
  `need` int(11) DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '0',
  `dateadd` year(4) NOT NULL,
  `class` int(11) NOT NULL,
  `life` year(4) NOT NULL,
  `amount` int(12) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Информация о школьных учебниках.';

-- Дамп данных таблицы library.workbooks: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `workbooks` DISABLE KEYS */;
INSERT INTO `workbooks` (`id`, `author`, `publishing`, `need`, `subject`, `dateadd`, `class`, `life`, `amount`) VALUES
	(1, 'test', 'test', 188, 'Русский язык', '2018', 1, '2038', 52),
	(2, 'test', 'test', 188, 'Математика 1/2', '2018', 1, '2038', 51),
	(3, 'test', 'test', 188, 'Физика', '2018', 1, '2038', 51),
	(4, 'test', 'test', 188, 'История', '2018', 1, '2038', 51),
	(5, 'test', 'test', 188, 'Базы данных', '2018', 2, '2038', 51),
	(6, 'test', 'test', 188, 'Основы программирования', '2018', 2, '2038', 51),
	(7, 'test', 'test', 188, 'Базы данных', '2018', 3, '2038', 51),
	(8, 'test', 'test', 72, 'Web-программирование', '2018', 4, '2023', 0);
/*!40000 ALTER TABLE `workbooks` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
