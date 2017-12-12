  --
-- CREATE USER 'useraccount'@'localhost' IDENTIFIED BY 'password';
-- REVOKE ALL PRIVILEGES ON *.* FROM 'useraccount'@'localhost'; REVOKE GRANT OPTION ON *.* FROM 'useraccount'@'localhost'; 
-- GRANT SELECT, INSERT, UPDATE, INDEX, ALTER, EVENT, TRIGGER ON *.* TO 'useraccount'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

  SET default_storage_engine=INNODB;
  CREATE DATABASE IF NOT EXISTS `elearning` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
  USE `elearning`;
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 15, 2017 at 09:23 AM
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
-- Table structure for table `course`
--
DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `calculateExamMedian`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `calculateExamMedian` (IN `examid` INT, OUT `median` DOUBLE, IN `newscore` INT)  begin
    DECLARE plussedScores int;
    declare numberoftests int;
    declare numberof int;
    declare plus int;
    CALL plusScores(plussedScores,examid);
    select COUNT(score) into numberoftests from user_testing where exam_id = examid;
    set plus = plussedScores+newscore;
    set numberof = numberoftests +1;
    set median = plus/numberof;
  END$$

DROP PROCEDURE IF EXISTS `calculateTestingMedian`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `calculateTestingMedian` (IN `testingid` INT, OUT `median` DOUBLE, IN `newscore` INT)  begin
    DECLARE plussedScores int;
    declare numberoftests int;
    declare numberof int;
    declare plus int;
    CALL plusScoresTesting(plussedScores,testingid);
    select COUNT(score) into numberoftests from user_testing where testing_id= testingid;
    set plus = plussedScores+newscore;
    set numberof = numberoftests +1;
    set median = plus/numberof;
  END$$

DROP PROCEDURE IF EXISTS `plusScores`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `plusScores` (OUT `totalscore` INT, IN `id` INT)  BEGIN
    DECLARE currentScore int;
    declare count int;
    DECLARE i, totalscorehere INT DEFAULT 0;
    DECLARE cur1 CURSOR FOR SELECT score
                            FROM user_testing
                            WHERE exam_id = id;
    SELECT count(*)
    INTO count
    FROM user_testing
    WHERE exam_id = 3;

    OPEN cur1;
    WHILE count > i DO
      FETCH cur1
      INTO currentScore;
      SET totalscorehere = totalscorehere + currentScore;
      SET i = 1 + i;
    END WHILE;
    SET totalscore = totalscorehere;
    CLOSE cur1;
  END$$

DROP PROCEDURE IF EXISTS `plusScoresTesting`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `plusScoresTesting` (OUT `totalscore` INT, IN `id` INT)  BEGIN
    DECLARE currentScore int;
    declare count int;
    DECLARE i, totalscorehere INT DEFAULT 0;
    DECLARE cur1 CURSOR FOR SELECT score
                            FROM user_testing
                            WHERE testing_id = id;
    SELECT count(*)
    INTO count
    FROM user_testing
    WHERE testing_id = id;

    OPEN cur1;
    WHILE count > i DO
      FETCH cur1
      INTO currentScore;
      SET totalscorehere = totalscorehere + currentScore;
      SET i = 1 + i;
    END WHILE;
    SET totalscore = totalscorehere;
    CLOSE cur1;
  END$$

DELIMITER ;


DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `article_class` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbimage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `clicknum` int(11) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`articleid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_attach`
--

DROP TABLE IF EXISTS `article_attach`;
CREATE TABLE IF NOT EXISTS `article_attach` (
  `attachid` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `savepath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `savename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` double NOT NULL,
  `ext` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `downloadnum` int(11) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`attachid`),
  KEY `article_ind` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `videoimg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videopath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `videotime` int(11) NOT NULL,
  `showimg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `viewnum` int(11) NOT NULL,
  `learnnum` int(11) NOT NULL,
  `istesting` tinyint(1) NOT NULL,
  `isshow` tinyint(1) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`courseid`),
  UNIQUE KEY `title` (`title`),
  KEY `course_ibfk_1` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `course`
--
DROP TRIGGER IF EXISTS `ins_testing`;
DELIMITER $$
CREATE TRIGGER `ins_testing` AFTER INSERT ON `course` FOR EACH ROW BEGIN
    insert into testing (course_id, donenum, examnum ,creationtime, updatetime) VALUES (new.courseid,0,0,now(),now());
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `course_class`
--

DROP TABLE IF EXISTS `course_class`;
CREATE TABLE IF NOT EXISTS `course_class` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`classid`),
  UNIQUE KEY `classname` (`classname`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `examid` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `questions` json NOT NULL,
  `options` json NOT NULL,
  `correctanwsers` json NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  `medianscore` double DEFAULT NULL,
  `donenum` int(11) NOT NULL,
  PRIMARY KEY (`examid`),
  UNIQUE KEY `title` (`title`),
  KEY `course_ind` (`course_id`),
  KEY `testing_id` (`testing_id`),
  KEY `class_ind` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `exam`
--
DROP TRIGGER IF EXISTS `ins_exam`;
DELIMITER $$
CREATE TRIGGER `ins_exam` AFTER INSERT ON `exam` FOR EACH ROW BEGIN
  update testing set examnum = examnum + 1 where testingid = new.testing_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `managerid` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime DEFAULT NULL,
  `creationip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lastloginip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loginnum` int(11) NOT NULL,
  PRIMARY KEY (`managerid`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `manager`
--
DROP TRIGGER IF EXISTS `ins_loginlog`;
DELIMITER $$
CREATE TRIGGER `ins_loginlog` AFTER INSERT ON `manager` FOR EACH ROW begin
    insert into manager_loginlog (manager_id,logintime,loginip) values (NEW.managerid,now(),new.creationip);
    insert into manager_role (manager_id,role_id) values (new.managerid,1); 
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
  `manager_id` int(11) NOT NULL,
  `logintime` datetime NOT NULL,
  `loginip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `browser` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`logid`),
  KEY `manager_ind` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `manager_loginlog`
--
DROP TRIGGER IF EXISTS `update_logintime`;
DELIMITER $$
CREATE TRIGGER `update_logintime` AFTER INSERT ON `manager_loginlog` FOR EACH ROW BEGIN
  IF @disable_update_logintime IS NULL THEN
  update manager set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where managerid = new.manager_id;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manager_role`
--

DROP TABLE IF EXISTS `manager_role`;
CREATE TABLE IF NOT EXISTS `manager_role` (
  `manager_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  KEY `manager_ind` (`manager_id`),
  KEY `role_ind` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scrollimage`
--

DROP TABLE IF EXISTS `scrollimage`;
CREATE TABLE IF NOT EXISTS `scrollimage` (
  `simgid` int(11) NOT NULL AUTO_INCREMENT,
  `image` blob NOT NULL,
  `img_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_size` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isshow` tinyint(1) NOT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`simgid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

DROP TABLE IF EXISTS `testing`;
CREATE TABLE IF NOT EXISTS `testing` (
  `testingid` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `donenum` int(11) NOT NULL,
  `examnum` int(11) NOT NULL,
  `medianpoints` double DEFAULT NULL,
  `creationtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`testingid`),
  KEY `course_ind` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `lastloginip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `loginnum` int(11) NOT NULL,
  `createtime` datetime NOT NULL,
  `updatetime` datetime NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `ins_loginlog_user`;
DELIMITER $$
CREATE TRIGGER `ins_loginlog_user` AFTER INSERT ON `user` FOR EACH ROW begin
    insert into user_loginlog (user_id,logintime,loginip,result) values (NEW.userid,now(),new.lastloginip,true);
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

DROP TABLE IF EXISTS `user_course`;
CREATE TABLE IF NOT EXISTS `user_course` (
  `usercourseid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `begintime` datetime NOT NULL,
  `completetime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`usercourseid`),
  KEY `user_ind` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `user_course`
--
DROP TRIGGER IF EXISTS `check_duplicate_user_course`;
DELIMITER $$
CREATE TRIGGER `check_duplicate_user_course` BEFORE INSERT ON `user_course` FOR EACH ROW begin
    declare currentcourseid int(11);
    if @disable_check_duplicate is not null THEN
      SELECT course_id into currentcourseid from user_course where user_id = new.user_id and course_id = new.course_id;
      if currentcourseid is not null
      THEN
        SIGNAL sqlstate '02000' SET MESSAGE_TEXT = 'duplicate entry';
      END IF;
    END IF;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_loginlog`
--

DROP TABLE IF EXISTS `user_loginlog`;
CREATE TABLE IF NOT EXISTS `user_loginlog` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `logintime` datetime NOT NULL,
  `loginip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY (`logid`),
  KEY `user_ind` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_testing`
--

DROP TABLE IF EXISTS `user_testing`;
CREATE TABLE IF NOT EXISTS `user_testing` (
  `usertestingid` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `testing_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `useranswers` json NOT NULL,
  `correctanwsers` json NOT NULL,
  `score` int(11) NOT NULL,
  `started` datetime NOT NULL,
  `completed` datetime NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY (`usertestingid`),
  KEY `user_ind` (`user_id`),
  KEY `testing_ind` (`testing_id`),
  KEY `exam_ind` (`exam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `user_testing`
--
DROP TRIGGER IF EXISTS `ins_user_testing`;
DELIMITER $$
CREATE TRIGGER `ins_user_testing` BEFORE INSERT ON `user_testing` FOR EACH ROW BEGIN
  declare exammedian int(11);
  DECLARE testingmedian int(11);
  DECLARE notfirsttime int(11);
  select user_id into notfirsttime from user_testing where user_testing.user_id = new.user_id and user_testing.exam_id = new.exam_id;
  if notfirsttime is not null THEN
    SIGNAL sqlstate '02420' SET MESSAGE_TEXT = 'duplicate exam entry for current user';
  END IF;
  if new.result=1 and notfirsttime is null THEN
    update testing set donenum = donenum + 1 where testingid = new.testing_id;
    update exam set donenum = donenum + 1 where examid = new.exam_id;

    select exam.medianscore into exammedian from exam where examid = new.exam_id;
    if exammedian>0 THEN
      call calculateExamMedian(new.exam_id,@median,new.score);
      update exam set exam.medianscore = @median where examid = new.exam_id;
    ELSE
      update exam set exam.medianscore = new.score where examid = new.exam_id;
    END IF;

    select testing.medianpoints into testingmedian from testing where testingid = new.testing_id;
    if testingmedian>0 THEN
      call calculateTestingMedian(new.testing_id,@mediantesting,new.score);
      update testing set testing.medianpoints = @mediantesting where testingid = new.testing_id;
    ELSE
      update testing set testing.medianpoints = new.score where testingid = new.testing_id;
    END IF;
  END IF;
END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_attach`
--
ALTER TABLE `article_attach`
  ADD CONSTRAINT `article_attach_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`articleid`) ON DELETE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `course_class` (`classid`) ON DELETE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_ibfk_2` FOREIGN KEY (`testing_id`) REFERENCES `testing` (`testingid`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `course_class` (`classid`) ON DELETE CASCADE;

--
-- Constraints for table `manager_loginlog`
--
ALTER TABLE `manager_loginlog`
  ADD CONSTRAINT `manager_loginlog_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`managerid`) ON DELETE CASCADE;

--
-- Constraints for table `manager_role`
--
ALTER TABLE `manager_role`
  ADD CONSTRAINT `manager_role_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`managerid`) ON DELETE CASCADE,
  ADD CONSTRAINT `manager_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`roleid`) ON DELETE CASCADE;

--
-- Constraints for table `testing`
--
ALTER TABLE `testing`
  ADD CONSTRAINT `testing_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`) ON DELETE CASCADE;

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `user_course_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`courseid`) ON DELETE CASCADE;

--
-- Constraints for table `user_loginlog`
--
ALTER TABLE `user_loginlog`
  ADD CONSTRAINT `user_loginlog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `user_testing`
--
ALTER TABLE `user_testing`
  ADD CONSTRAINT `user_testing_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_testing_ibfk_2` FOREIGN KEY (`testing_id`) REFERENCES `testing` (`testingid`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_testing_ibfk_3` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`examid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
