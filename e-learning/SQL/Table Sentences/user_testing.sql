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
      update exam set exam.medianscore = (exammedian+new.score)/2 where examid = new.exam_id;
    ELSE
      update exam set exam.medianscore = new.score where examid = new.exam_id;
    END IF;

    select testing.medianpoints into testingmedian from testing where testingid = new.testing_id;
    if testingmedian>0 THEN
      update testing set testing.medianpoints = (testingmedian+new.score)/2 where testingid = new.testing_id;
    ELSE
      update testing set testing.medianpoints = new.score where testingid = new.testing_id;
    END IF;
  END IF;
END
$$
DELIMITER ;