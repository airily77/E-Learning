create table course(
  courseid INT NOT NULL auto_increment,
  title varchar(100) not null unique,
  description varchar(500) null,
  videoimg varchar(100) not null,
  videopath varchar(100) not null,
  videotime int not null,
  showimg varchar(100) not null,
  class_id INT not null,
  viewnum int not null, -- Remember to do this when the page is completed. 
  learnnum int not null,
  istesting boolean not null,
  isshow boolean not null,
  creationtime datetime not null,
  updatetime datetime not null,
  PRIMARY KEY (courseid)
)ENGINE=INNODB;

create trigger ins_testing after insert on course for EACH ROW BEGIN
  insert into testing (course_id, donenum, examnum ,creationtime, updatetime) VALUES (new.courseid,0,0,now(),now());
END;