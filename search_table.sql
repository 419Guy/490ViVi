-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `search_table`;
CREATE TABLE `search_table` (
  `id` int(3) NOT NULL,
  `search` varchar(225) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `search_table` (`id`, `search`, `date`) VALUES
(2,	'comptia',	'2016-11-06 22:34:38'),
(7,	'comptia',	'2016-11-06 22:51:08'),
(7,	'mcgraw',	'2016-11-06 23:16:06'),
(7,	'meyers',	'2016-11-06 23:16:28'),
(7,	'mcgraw',	'2016-11-06 23:16:28'),
(2,	'Georgia Weidman',	'2016-11-07 09:50:40'),
(2,	'Weidman',	'2016-11-07 09:51:59'),
(2,	'it 490',	'2016-11-07 09:57:53'),
(2,	'security',	'2016-11-07 10:00:16'),
(2,	'penetration testing',	'2016-11-07 10:16:24'),
(6,	'IT',	'2016-11-07 10:17:02'),
(6,	'mgmt 390',	'2016-11-07 10:17:15'),
(6,	'tran',	'2016-11-07 10:20:16'),
(6,	'tran 650',	'2016-11-07 10:20:29'),
(6,	'williams',	'2016-11-07 10:25:56'),
(6,	'tran 650',	'2016-11-07 10:26:59'),
(2,	'security',	'2016-11-07 15:01:01');

-- 2016-11-07 20:45:17
