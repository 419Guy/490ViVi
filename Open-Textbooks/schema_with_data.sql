-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2012 at 07:31 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `textyard`
--

-- --------------------------------------------------------

--
-- Table structure for table `Bookstores`
--

CREATE TABLE `Bookstores` (
  `Bookstore_ID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `Bookstore_Type_ID` tinyint(10) unsigned NOT NULL,
  `Storefront_URL` varchar(2043) NOT NULL COMMENT 'URL used when we want to link students to the bookstore (typically because we don''t have a given book)',
  `Fetch_URL` varchar(2043) NOT NULL COMMENT 'URL used to fetch Class-Items data from the bookstore',
  `Store_Value` varchar(100) DEFAULT NULL COMMENT 'Store identifier used in BN and Follet bookstores',
  `Follett_HEOA_Store_Value` varchar(100) DEFAULT NULL COMMENT 'Follett_HEOA_Store_Value',
  `Multiple_Campuses` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`Bookstore_ID`),
  KEY `Bookstore_Type_ID` (`Bookstore_Type_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1280 ;

--
-- Dumping data for table `Bookstores`
--


INSERT INTO `Bookstores` VALUES(1, 4, 'http://www.bkstr.com/Home/10001-10555-1', 'http://www.bkstr.com/','10555','584', NULL);



-- --------------------------------------------------------

--
-- Table structure for table `Bookstore_Types`
--

CREATE TABLE `Bookstore_Types` (
  `Bookstore_Type_ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `Bookstore_Type_Name` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Bookstore_Type_ID`),
  UNIQUE KEY `Bookstore_Type_Name` (`Bookstore_Type_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Bookstore_Types`
--

INSERT INTO `Bookstore_Types` VALUES(1, 'Barnes and Nobles');
INSERT INTO `Bookstore_Types` VALUES(3, 'CampusHub');
INSERT INTO `Bookstore_Types` VALUES(5, 'ePOS');
INSERT INTO `Bookstore_Types` VALUES(4, 'Follett');
INSERT INTO `Bookstore_Types` VALUES(2, 'MBS');
INSERT INTO `Bookstore_Types` VALUES(6, 'Neebo');

-- --------------------------------------------------------

--
-- Table structure for table `Campuses`
--

CREATE TABLE `Campuses` (
  `Campus_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Bookstore_ID` int(10) unsigned NOT NULL,
  `Campus_Value` varchar(100) DEFAULT NULL COMMENT 'Some Follett schools require this (e.g. Ivy Techs), also BN always requires it.',
  `Program_Value` varchar(100) DEFAULT NULL COMMENT 'Identifier for "Programs" used in Follets system.  E.g. there could be a program for college and a program for a HS.  Only used in Follett systems',
  `Location` tinytext NOT NULL,
  `Added_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'when the campuses was added to db',
  `Enabled` enum('Y','N') NOT NULL,
  PRIMARY KEY (`Campus_ID`),
  KEY `Bookstore_ID` (`Bookstore_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1304 ;

--
-- Dumping data for table `Campuses`
--



INSERT INTO `Campuses` VALUES(1, 1, NULL, 'ALL', 'Newark, NJ', '2016-10-20 20:04:13', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `Campus_Names`
--

CREATE TABLE `Campus_Names` (
  `Campus_ID` int(10) unsigned NOT NULL,
  `Campus_Name` varchar(255) NOT NULL,
  `Is_Primary` enum('Y','N') CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`Campus_ID`,`Campus_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Campus_Names`
--


INSERT INTO `Campus_Names` VALUES(1, 'NJIT', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `Classes_Cache`
--

CREATE TABLE `Classes_Cache` (
  `Class_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Course_ID` int(10) unsigned NOT NULL,
  `Class_Code` varchar(50) NOT NULL COMMENT 'Class_Code known/shown to students',
  `Instructor` varchar(50) DEFAULT NULL,
  `Class_Value` varchar(100) NOT NULL COMMENT 'value sent to the Bookstore',
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Class_ID`),
  UNIQUE KEY `Course_Class` (`Course_ID`,`Class_Value`),
  KEY `Course_ID` (`Course_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46444 ;

--
-- Dumping data for table `Classes_Cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `Class_Items_Cache`
--

CREATE TABLE `Class_Items_Cache` (
  `Class_Items_Cache_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Actually used in sorting, to tell us the importance of Books (based on the order  in which they were received when fetched from bookstore',
  `Class_ID` int(10) unsigned NOT NULL,
  `Item_ID` int(10) unsigned DEFAULT NULL,
  `Bookstore_Price` decimal(5,2) DEFAULT NULL COMMENT 'We store here rather than Items, because you could have the same Item being listed at different prices depending  on the bookstore.',
  `New_Price` decimal(5,2) unsigned DEFAULT NULL,
  `Used_Price` decimal(5,2) unsigned DEFAULT NULL,
  `New_Rental_Price` decimal(5,2) unsigned DEFAULT NULL,
  `Used_Rental_Price` decimal(5,2) unsigned DEFAULT NULL,
  `Necessity` varchar(50) DEFAULT NULL COMMENT 'e.g. "Required", "Recommended", etc.  We grab from Bookstore',
  `Comments` varchar(1000) DEFAULT NULL,
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Class_Items_Cache_ID`),
  UNIQUE KEY `Class_Item` (`Class_ID`,`Item_ID`),
  KEY `Item_ID` (`Item_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `Class_Items_Cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `Courses_Cache`
--

CREATE TABLE `Courses_Cache` (
  `Course_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Department_ID` int(10) unsigned NOT NULL,
  `Course_Code` varchar(100) NOT NULL COMMENT 'Course_Code known/shown to students',
  `Course_Value` varchar(100) DEFAULT NULL COMMENT 'value sent to the Bookstore.  It can be NULL because of the Neebo situation where specific courses are never sent to the bookstore..',
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Course_ID`),
  UNIQUE KEY `Department_Course` (`Department_ID`,`Course_Value`),
  KEY `Department_ID` (`Department_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115202 ;

--
-- Dumping data for table `Courses_Cache`
--

INSERT INTO `Courses_Cache` VALUES(115090, 158397, '21000', '21000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115091, 158397, '21910', '21910', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115092, 158397, '25100', '25100', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115093, 158397, '25200', '25200', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115094, 158397, '34000', '34000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115095, 158397, '35200', '35200', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115096, 158397, '36000', '36000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115097, 158397, '36100', '36100', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115098, 158397, '37000', '37000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115099, 158397, '38000', '38000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115100, 158397, '41900', '41900', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115101, 158397, '45100', '45100', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115102, 158397, '49000', '49000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115103, 158397, '49900', '49900', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115104, 158397, '51200', '51200', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115105, 158397, '59000', '59000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115106, 158397, '60900', '60900', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115107, 158397, '61000', '61000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115108, 158397, '61200', '61200', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115109, 158397, '61300', '61300', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115110, 158397, '61400', '61400', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115111, 158397, '61800', '61800', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115112, 158397, '63000', '63000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115113, 158397, '63100', '63100', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115114, 158397, '65000', '65000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115115, 158397, '66800', '66800', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115116, 158397, '67100', '67100', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115117, 158397, '67200', '67200', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115118, 158397, '68600', '68600', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115119, 158397, '69000', '69000', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115120, 158397, '69900', '69900', '2012-02-10 14:51:12');
INSERT INTO `Courses_Cache` VALUES(115121, 158518, '001A', '001A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115122, 158518, '001B', '001B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115123, 158518, '024', '024', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115124, 158518, '043A', '043A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115125, 158518, '043B', '043B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115126, 158518, '045A', '045A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115127, 158518, '045B', '045B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115128, 158518, '045C', '045C', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115129, 158518, '084', '084', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115130, 158518, '098', '098', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115131, 158518, '099', '099', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115132, 158518, '101', '101', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115133, 158518, '107', '107', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115134, 158518, '117B', '117B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115135, 158518, '117S', '117S', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115136, 158518, '118', '118', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115137, 158518, '119', '119', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115138, 158518, '125A', '125A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115139, 158518, '125C', '125C', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115140, 158518, '130B', '130B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115141, 158518, '130D', '130D', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115142, 158518, '133B', '133B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115143, 158518, '133T', '133T', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115144, 158518, '134', '134', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115145, 158518, '136', '136', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115146, 158518, '137T', '137T', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115147, 158518, '141', '141', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115148, 158518, '143A', '143A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115149, 158518, '143B', '143B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115150, 158518, '143C', '143C', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115151, 158518, '143N', '143N', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115152, 158518, '143T', '143T', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115153, 158518, '161', '161', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115154, 158518, '165', '165', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115155, 158518, '166', '166', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115156, 158518, '166AC', '166AC', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115157, 158518, '171', '171', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115158, 158518, '176', '176', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115159, 158518, '180A', '180A', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115160, 158518, '180E', '180E', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115161, 158518, '180Z', '180Z', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115162, 158518, '190', '190', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115163, 158518, '195B', '195B', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115164, 158518, '198', '198', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115165, 158518, '199', '199', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115166, 158518, '203', '203', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115167, 158518, '211', '211', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115168, 158518, '212', '212', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115169, 158518, '243N', '243N', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115170, 158518, '250', '250', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115171, 158518, '298', '298', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115172, 158518, '299', '299', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115173, 158518, '310', '310', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115174, 158518, '602', '602', '2012-02-10 15:10:53');
INSERT INTO `Courses_Cache` VALUES(115175, 158652, '100', '100', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115176, 158652, '200', '200', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115177, 158652, '210', '210', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115178, 158652, '211', '211', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115179, 158652, '300', '300', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115180, 158652, '312', '312', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115181, 158652, '313', '313', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115182, 158652, '330', '330', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115183, 158652, '342', '342', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115184, 158652, '345', '345', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115185, 158652, '349', '349', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115186, 158652, '350', '350', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115187, 158652, '365', '365', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115188, 158652, '369', '369', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115189, 158652, '414', '414', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115190, 158652, '435', '435', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115191, 158652, '436', '436', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115192, 158652, '440', '440', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115193, 158652, '490', '490', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115194, 158652, '495', '495', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115195, 158652, '499', '499', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115196, 158652, '542', '542', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115197, 158652, '641', '641', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115198, 158652, '645', '645', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115199, 158652, '680', '680', '2012-02-10 15:17:52');
INSERT INTO `Courses_Cache` VALUES(115200, 158731, 'ACCOUNTING 2301', NULL, '2012-02-10 20:22:58');
INSERT INTO `Courses_Cache` VALUES(115201, 158731, 'ACCOUNTING 2302', NULL, '2012-02-10 20:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `Departments_Cache`
--

CREATE TABLE `Departments_Cache` (
  `Department_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Division_ID` int(10) unsigned NOT NULL,
  `Department_Code` varchar(50) NOT NULL COMMENT 'Department_Code shown/known to students',
  `Department_Value` varchar(100) NOT NULL COMMENT 'value sent to the Bookstore',
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Department_ID`),
  UNIQUE KEY `Term_Department` (`Division_ID`,`Department_Code`),
  KEY `Term_ID` (`Division_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=158764 ;

--
-- Dumping data for table `Departments_Cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `Divisions_Cache`
--

CREATE TABLE `Divisions_Cache` (
  `Division_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Term_ID` int(10) unsigned NOT NULL,
  `Division_Name` varchar(100) DEFAULT NULL COMMENT 'It can be NULL because sometimes we have placeholders',
  `Division_Value` varchar(100) DEFAULT NULL COMMENT 'It can be NULL because sometimes we have placeholders',
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Division_ID`),
  KEY `Term_ID` (`Term_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2076 ;

--
-- Dumping data for table `Divisions_Cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE `Items` (
  `Item_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ISBN` char(13) DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Edition` varchar(20) NOT NULL DEFAULT '''''',
  `Authors` varchar(255) NOT NULL DEFAULT '''''',
  `Year` year(4) NOT NULL DEFAULT '0000',
  `Publisher` varchar(50) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`Item_ID`),
  UNIQUE KEY `Unique_Item` (`Title`,`Edition`,`Authors`,`Year`,`Publisher`),
  UNIQUE KEY `ISBN` (`ISBN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Items includes, but is not limited to isbn-having books.' AUTO_INCREMENT=33772 ;

--
-- Dumping data for table `Items`
--


-- --------------------------------------------------------

--
-- Table structure for table `Terms_Cache`
--

CREATE TABLE `Terms_Cache` (
  `Term_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Campus_ID` int(10) unsigned NOT NULL,
  `Term_Name` varchar(50) NOT NULL COMMENT 'Shown in drop down',
  `Term_Value` varchar(100) NOT NULL COMMENT 'Sent to Bookstore',
  `Follett_HEOA_Term_Value` varchar(100) DEFAULT NULL COMMENT 'Value sent to the Follett HEOA page',
  `Cache_TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Term_ID`),
  UNIQUE KEY `Campus_Term` (`Campus_ID`,`Term_Value`),
  KEY `Campus_ID` (`Campus_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5873 ;

--
-- Dumping data for table `Terms_Cache`
--

INSERT INTO `Terms_Cache` VALUES(3810, 101, 'SPRING 2012', '100021593', '2012B', '2012-02-10 15:08:38');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Campus_Names`
--
ALTER TABLE `Campus_Names`
  ADD CONSTRAINT `Campus_Names_ibfk_1` FOREIGN KEY (`Campus_ID`) REFERENCES `Campuses` (`Campus_ID`);

--
-- Constraints for table `Classes_Cache`
--
ALTER TABLE `Classes_Cache`
  ADD CONSTRAINT `Classes_Cache_ibfk_1` FOREIGN KEY (`Course_ID`) REFERENCES `Courses_Cache` (`Course_ID`);
