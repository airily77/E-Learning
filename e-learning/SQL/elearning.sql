--
-- Database: `elearning`
--
CREATE DATABASE IF NOT EXISTS `elearning` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `elearning`;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `managerid` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  `creationip` varchar(20) NOT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lastloginip` varchar(20) DEFAULT NULL,
  `loginnum` int(11) NOT NULL,
  PRIMARY KEY (`managerid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`managerid`, `account`, `password`, `status`, `creationtime`, `updatetime`, `creationip`, `lastlogintime`, `lastloginip`, `loginnum`) VALUES
  (1, 'pekka', 'pekka', 3, '2017-11-08 11:52:38', NULL, '127.0.0.1', '2017-11-08 13:51:09', '127.0.0.1', 3),
  (2, 'pekka', 'pekka', 3, '2017-11-08 11:54:38', NULL, '127.0.0.1', NULL, '127.0.0.1', 1),
  (3, 'pekka', 'pekka', 3, '2017-11-08 11:55:28', NULL, '127.0.0.1', NULL, '127.0.0.1', 1),
  (4, 'password', 'password', 3, '2017-11-08 15:47:07', '2017-11-08 15:47:07', '127.0.0.1', '2017-11-08 15:47:07', '127.0.0.1', 1);

--
-- Triggers `manager`
--
DROP TRIGGER IF EXISTS `ins_loginlog`;
DELIMITER $$
CREATE TRIGGER `ins_loginlog` AFTER INSERT ON `manager` FOR EACH ROW
IF @disable_triggers IS NULL THEN
    insert into manager_loginlog (managerid,logintime,loginip) values (NEW.managerid,now(),NEW.creationip);
END IF;
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
  `browser` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager_loginlog`
--

INSERT INTO `manager_loginlog` (`logid`, `managerid`, `logintime`, `loginip`, `browser`) VALUES
  (1, 1, '2017-11-08 11:52:38', NULL, NULL),
  (2, 2, '2017-11-08 11:54:38', NULL, NULL),
  (3, 3, '2017-11-08 11:55:28', NULL, NULL),
  (4, 1, '2017-11-08 13:42:12', '127.0.0.1', 'firefox'),
  (5, 1, '2017-11-08 13:42:40', '127.0.0.1', 'firefox'),
  (6, 1, '2017-11-08 13:50:58', '127.0.0.1', 'firefox'),
  (7, 1, '2017-11-08 13:51:09', '127.0.0.1', 'firefox'),
  (8, 4, '2017-11-08 15:47:07', '127.0.0.1', NULL);

--
-- Triggers `manager_loginlog`
--
DROP TRIGGER IF EXISTS `update_logintime`;
DELIMITER $$


CREATE TRIGGER `update_logintime` AFTER INSERT ON `manager_loginlog` FOR EACH ROW
  IF @disable_update_logintime IS NULL THEN
    update manager set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where managerid = new.managerid;
  END IF;
$$
DELIMITER ;
