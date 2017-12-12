create table user_testing(
	usertestingid int not null auto_increment,
	user_id int not null,
	testing_id int not null, -- Remember take this from the test he/she has completed. Because if you take this testing_id from course it can be wrong. Courses can have multiple different testings.
	exam_id int not null,
	useranswers json not null,
	correctanwsers json not null,
	score int not null,
	started datetime not null,
	completed datetime not null,
	result boolean not null,
	PRIMARY KEY (usertestingid),
	INDEX user_ind (user_id),
    FOREIGN KEY (user_id)
        REFERENCES user(userid)
        ON DELETE CASCADE,
    INDEX testing_ind (testing_id),
    FOREIGN KEY (testing_id)
    	REFERENCES testing(testingid)
    	ON DELETE CASCADE,
    INDEX exam_ind (exam_id),
    FOREIGN KEY (exam_id)
    	REFERENCES exam(examid)
    	ON DELETE CASCADE
)ENGINE=INNODB;

DROP TRIGGER IF EXISTS `ins_user_testing`;
DELIMITER $$
CREATE TRIGGER `ins_user_testing` BEFORE INSERT ON `user_testing` FOR EACH ROW BEGIN
  declare exammedian int(11);
  DECLARE testingmedian int(11);
  DECLARE notfirsttime int(11);
  select user_id into notfirsttime from user_testing where user_testing.user_id = new.user_id and user_testing.exam_id = new.exam_id;
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

create PROCEDURE calculateExamMedian(IN examid INT,OUT median double,in newscore int)
  begin
    DECLARE plussedScores int;
    declare numberoftests int;
    declare numberof int;
    declare plus int;
    CALL plusScores(plussedScores,examid);
    select COUNT(score) into numberoftests from user_testing where exam_id = examid;
    set plus = plussedScores+newscore;
    set numberof = numberoftests +1;
    set median = plus/numberof;
  END;
CREATE PROCEDURE plusScores(OUT totalscore INT,in id int)
  BEGIN
    DECLARE currentScore int;
    declare count int;
    DECLARE i, totalscorehere INT DEFAULT 0;
    DECLARE cur1 CURSOR FOR SELECT score
                            FROM user_testing
                            WHERE exam_id = id;
    SELECT count(*)
    INTO count
    FROM user_testing
    WHERE exam_id = id;

    OPEN cur1;
    WHILE count > i DO
      FETCH cur1
      INTO currentScore;
      SET totalscorehere = totalscorehere + currentScore;
      SET i = 1 + i;
    END WHILE;
    SET totalscore = totalscorehere;
    CLOSE cur1;
  END;

create PROCEDURE calculateTestingMedian(IN testingid INT,OUT median double,in newscore int)
  begin
    DECLARE plussedScores int;
    declare numberoftests int;
    declare numberof int;
    declare plus int;
    CALL plusScoresTesting(plussedScores,testingid);
    select COUNT(score) into numberoftests from user_testing where testing_id= testingid;
    set plus = plussedScores+newscore;
    set numberof = numberoftests +1;
    set median = plus/numberof;
  END;
CREATE PROCEDURE plusScoresTesting(OUT totalscore INT,in id int)
  BEGIN
    DECLARE currentScore int;
    declare count int;
    DECLARE i, totalscorehere INT DEFAULT 0;
    DECLARE cur1 CURSOR FOR SELECT score
                            FROM user_testing
                            WHERE testing_id = id;
    SELECT count(*)
    INTO count
    FROM user_testing
    WHERE testing_id = 3;

    OPEN cur1;
    WHILE count > i DO
      FETCH cur1
      INTO currentScore;
      SET totalscorehere = totalscorehere + currentScore;
      SET i = 1 + i;
    END WHILE;
    SET totalscore = totalscorehere;
    CLOSE cur1;
  END;