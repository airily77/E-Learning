--
-- Database: `elearning`
--
CREATE DATABASE IF NOT EXISTS `elearning` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `elearning`;
ALTER DATABASE elearning DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 09, 2017 at 01:39 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `managerid` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `password` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  `creationip` varchar(20) NOT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lastloginip` varchar(20) DEFAULT NULL,
  `loginnum` int(11) NOT NULL,
  PRIMARY KEY (`managerid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

--

--
-- Triggers `manager`
--
DROP TRIGGER IF EXISTS `ins_after_manager`;
DELIMITER $$
CREATE TRIGGER `ins_after_manager` AFTER INSERT ON `manager` FOR EACH ROW begin
    insert into manager_loginlog (managerid,logintime,loginip) values (NEW.managerid,now(),new.creationip);
    insert into manager_role (managerid,roleid) values (new.managerid,1);
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manager_loginlog`
--

DROP TABLE IF EXISTS `manager_loginlog`;
CREATE TABLE IF NOT EXISTS `manager_loginlog` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `managerid` int(11) NOT NULL,
  `logintime` datetime NOT NULL,
  `loginip` varchar(20) DEFAULT NULL,
  result boolean null,
  `browser` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

--
-- Dumping data for table `manager_loginlog`
--

--
-- Triggers `manager_loginlog`
--
DROP TRIGGER IF EXISTS `update_logintime`;
DELIMITER $$
CREATE TRIGGER `update_logintime` AFTER INSERT ON `manager_loginlog` FOR EACH ROW IF @disable_update_logintime IS NULL THEN
    update manager set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where managerid = new.managerid;
  END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manager_role`
--

DROP TABLE IF EXISTS `manager_role`;
CREATE TABLE IF NOT EXISTS `manager_role` (
  `managerid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

--
-- Dumping data for table `manager_role`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rolename`, `creationtime`, `updatetime`) VALUES
('测试管理员', '2017-11-09 07:56:02', '2017-11-09 07:56:02');
INSERT INTO `role` (`rolename`, `creationtime`, `updatetime`) VALUES
('综合管理员', '2017-11-09 10:26:03','2017-11-09 10:26:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
