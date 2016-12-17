-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `bundles`;
CREATE TABLE `bundles` (
  `Name` varchar(100) NOT NULL,
  `Version` varchar(6) NOT NULL,
  `Time_Received` datetime DEFAULT NULL,
  PRIMARY KEY (`Name`,`Version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bundles` (`Name`, `Version`, `Time_Received`) VALUES
('backend',	'1.0-1',	'2016-11-29 10:35:14'),
('BIT490',	'1.1-2',	'2016-12-16 16:23:48'),
('BROKENIT490',	'1.1-1',	'2016-12-16 17:08:55'),
('frontend',	'1.1-2',	'2016-11-29 10:35:50'),
('frontend',	'1.1-3',	'2016-11-29 10:33:58'),
('frontend',	'1.2',	NULL),
('frontend',	'1.3',	'2016-12-16 17:11:10'),
('it490',	'1.0-1',	NULL),
('IT490',	'1.1-2',	NULL),
('testtwobe',	'1.0-1',	'2016-11-29 11:54:24');

-- 2016-12-17 04:07:08
