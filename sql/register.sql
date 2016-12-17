-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `register`;
CREATE TABLE `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `registration_time` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `register` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `registration_time`, `login_time`) VALUES
(1,	'Saitama',	'Punch',	'sp001',	'sp001@njit.edu',	'168c8cf7a91a15783a9d4b5825855b1470021201c8f02d17953ca3c97ee9aed0',	'2016-10-10 23:30:16',	'2016-10-13 10:15:35'),
(2,	'Mob',	'Psycho',	'mp100',	'mp100@njit.edu',	'16a62452f30a8d659ec6b7f7c675783cc2dc64dad2ee1edb3bfd6ff05974c1b1',	'2016-10-11 00:09:56',	'2016-12-16 16:49:39'),
(3,	'Cloud',	'Strife',	'cs007',	'cs007@njit.edu',	'983a09430894812899cfda83ac05b820393be240050d39400d38694a49f2e57c',	'2016-10-11 00:40:42',	'2016-12-16 16:00:56'),
(4,	'Byakuya',	'Kuchiki',	'bk006',	'bk006@njit.edu',	'4fd67229c49086b719d359b0fd34a585d607887537eb7db465fcab5556d919d5',	'2016-10-11 08:28:40',	'2016-10-11 08:59:12'),
(5,	'Barry',	'Allen',	'TheFlash',	'theflash@justiceleague.com',	'9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',	'2016-10-11 11:56:05',	'2016-10-11 11:56:56'),
(6,	'Optimus',	'Prime',	'op13',	'op13@njit.edu',	'6e00cd562cc2d88e238dfb81d9439de7ec843ee9d0c9879d549cb1436786f975',	'2016-10-23 18:44:34',	'2016-12-16 15:51:58'),
(7,	'Bruce',	'Wayne',	'brw12',	'brw12@njit.edu',	'1532e76dbe9d43d0dea98c331ca5ae8a65c5e8e8b99d3e2a42ae989356f6242a',	'2016-10-23 21:24:36',	'2016-12-16 17:49:45'),
(8,	'Kaito',	'Kid',	'kk142',	'kk142@njit.edu',	'5c77d7fd8f51ed0c2a913e46326ff6d2ea2e95c8ecf1667c72eb72ccc3fc2b46',	'2016-10-24 15:09:24',	'2016-10-24 15:09:24'),
(9,	'Clark',	'Kent',	'Superman123',	'JLA@jleague.com',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-02 16:11:10',	'2016-11-02 16:11:10'),
(10,	'Karan',	'Patel',	'kp002',	'kp002@njitedu',	'92719fe0cf8cd51592af31ee8a5736d79f7273777fa3f7b70bfe993a4cd32180',	'2016-11-02 17:49:15',	'2016-11-02 17:49:15'),
(11,	'Allen',	'Walker',	'dgrayman',	'jdb49@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-05 16:07:04',	'2016-11-05 16:07:04'),
(12,	'Jerome',	'Bolante',	'test123',	'njit@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-05 16:15:21',	'2016-11-05 16:15:21'),
(13,	'Alex',	'Kwok',	'meow',	'meow@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-05 16:50:53',	'2016-11-05 17:00:09'),
(14,	'Shogo',	'Makishima',	'psychopass',	'arf@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-05 16:54:41',	'2016-11-05 16:54:41'),
(15,	'Jerome',	'Bolante',	'jdb49',	'jdb49@njit.edu',	'937e8d5fbb48bd4949536cd65b8d35c426b80d2f830c5c308e2cdec422ae2244',	'2016-11-07 20:11:51',	'2016-11-07 20:11:51'),
(16,	'404',	'Guy',	'404Guy',	'404Guy@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-08 08:46:44',	'2016-11-08 10:43:42'),
(17,	'Ai',	'Lim',	'ai003',	'ai003@njit.edu',	'32e83e92d45d71f69dcf9d214688f0375542108631b45d344e5df2eb91c11566',	'2016-11-19 13:59:19',	'2016-11-19 13:59:37'),
(18,	'Jerome',	'Bolster',	'JeremyBolster',	'JB123@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-19 14:00:29',	'2016-11-19 14:05:27'),
(19,	'',	'',	'Doomsday1',	'killjl@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-11-19 15:09:55',	'2016-11-19 15:11:07'),
(21,	'',	'',	'',	'',	'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',	'2016-12-16 15:35:39',	'2016-12-16 15:35:39'),
(22,	'Jonard',	'Bolante',	'Link123',	'link123@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-12-16 15:44:14',	'2016-12-16 15:44:14'),
(23,	'Mew',	'Two',	'mewtwo',	'testt@njit.edu',	'ecd71870d1963316a97e3ac3408c9835ad8cf0f3c1bc703527c30265534f75ae',	'2016-12-16 17:44:45',	'2016-12-16 17:44:45');

-- 2016-12-17 04:10:44
