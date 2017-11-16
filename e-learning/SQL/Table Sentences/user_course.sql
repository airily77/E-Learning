create table user_course(
	usercourseid int not null auto_increment,
	user_id INT NOT NULL,
	course_id INT NOT NULL,
	status boolean not null,
	begintime datetime not null,
	completetime datetime not null,
	PRIMARY KEY (usercourseid),
    INDEX user_ind (user_id),
    FOREIGN KEY (user_id)
        REFERENCES user(userid)
        ON DELETE CASCADE,
    INDEX course_id (course_id),
    FOREIGN KEY (course_id)
        REFERENCES course(courseid)
        ON 	DELETE CASCADE    
)ENGINE=INNODB;

DELIMITER $	
create trigger check_duplicate_user_course before insert on user_course FOR EACH ROW
  begin
    declare currentcourseid int(11);
    if @disable_check_duplicate is not null THEN
      SELECT course_id into currentcourseid from user_course where user_id = new.user_id and course_id = new.course_id;
      if currentcourseid is not null
      THEN
          SIGNAL sqlstate '02000' SET MESSAGE_TEXT = 'duplicate entry';
      END IF;
    END IF;
  END
DELIMITER ;
