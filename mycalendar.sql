-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.1.73-community - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных mycalendar
CREATE DATABASE IF NOT EXISTS `mycalendar` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mycalendar`;


-- Дамп структуры для таблица mycalendar.dl_group_user
CREATE TABLE IF NOT EXISTS `dl_group_user` (
  `id_group` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_group`,`id_user`),
  KEY `FK_group_for_user` (`id_user`),
  CONSTRAINT `FK_group_for_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_group_for_group` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.dl_group_user: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `dl_group_user` DISABLE KEYS */;
INSERT INTO `dl_group_user` (`id_group`, `id_user`) VALUES
	(6, 1),
	(6, 2),
	(7, 2);
/*!40000 ALTER TABLE `dl_group_user` ENABLE KEYS */;


-- Дамп структуры для таблица mycalendar.dl_task_user
CREATE TABLE IF NOT EXISTS `dl_task_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_task` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_task` (`id_task`),
  KEY `FK_user` (`id_user`),
  CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_task` FOREIGN KEY (`id_task`) REFERENCES `task` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.dl_task_user: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `dl_task_user` DISABLE KEYS */;
INSERT INTO `dl_task_user` (`id`, `id_user`, `id_task`) VALUES
	(2, 1, 4),
	(3, 1, 5),
	(4, 1, 8),
	(5, 1, 9),
	(6, 1, 10),
	(7, 2, 10);
/*!40000 ALTER TABLE `dl_task_user` ENABLE KEYS */;


-- Дамп структуры для таблица mycalendar.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `id_creator` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`),
  KEY `FK_G_U` (`id_creator`),
  CONSTRAINT `FK_G_U` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.groups: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `id_creator`) VALUES
	(6, 'PI-13-6', 1),
	(7, 'By ALEX', 2);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Дамп структуры для таблица mycalendar.notify
CREATE TABLE IF NOT EXISTS `notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(500) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL,
  `id_task_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_task_user` (`id_task_user`),
  CONSTRAINT `FK_task_user` FOREIGN KEY (`id_task_user`) REFERENCES `dl_task_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.notify: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `notify` DISABLE KEYS */;
/*!40000 ALTER TABLE `notify` ENABLE KEYS */;


-- Дамп структуры для таблица mycalendar.task
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `description` varchar(500) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `id_group` int(11) DEFAULT '0',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `id_creator` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_creator_task` (`id_creator`),
  KEY `FK_group_task` (`id_group`),
  CONSTRAINT `FK_group_task` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`),
  CONSTRAINT `FK_creator_task` FOREIGN KEY (`id_creator`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.task: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `name`, `description`, `id_group`, `start_time`, `end_time`, `id_creator`) VALUES
	(4, '0asdasd', 'asdsadasds', 6, '2015-12-14 22:14:24', '2015-12-14 22:14:26', 1),
	(5, 'asdasd', 'asdasdasdsads', 6, '0002-02-12 23:13:00', '2112-02-21 22:21:00', 1),
	(6, 'sad asd as', 'asd sad asd', 7, '2015-12-06 00:00:00', '2015-12-26 00:00:00', 2),
	(7, 'My First Task', 'Big Info', NULL, '2015-12-11 00:00:00', '2015-12-27 00:00:00', 1),
	(8, 'asdasdass', 'asdasdsa', NULL, '2015-12-18 01:01:00', '2017-05-03 00:00:00', 1),
	(9, 'YEAAAAA', 'YEAAAAA', NULL, '2017-02-02 00:00:00', '2019-02-03 01:02:00', 1),
	(10, 'Triyng', 'Triyng', 6, '2016-01-01 00:00:00', '2017-02-01 00:00:00', 1);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;


-- Дамп структуры для таблица mycalendar.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `hash` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Индекс 2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Дамп данных таблицы mycalendar.user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `login`, `email`, `name`, `password`, `hash`) VALUES
	(1, 'krava', 'krapahkrm@gmail.com', 'Alexander', 'qwerty', 'yeah'),
	(2, 'krava2', 'asdfasfsdaf', 'Alexander2', 'qwerty', 'yeah');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
