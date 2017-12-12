create table exam(
	examid int not null auto_increment,
	course_id int not null,
	testing_id int not null,
	class_id int not null,
	title varchar(100) not null unique,
	questions json not null,
	options json not null, -- Question 1 Option A = 'test option' Option B = 'this is option b' Option C = 'this is option c', Question 2 Option A = 'plah' etc
	correctanwsers json not null, -- Question 1 = A, Question 2 = C etc
	creationtime datetime not null,
	updatetime datetime not null,
	donenum int not null,
	medianscore double null,
	PRIMARY KEY (examid),
	INDEX course_ind (course_id),
    FOREIGN KEY (course_id)
        REFERENCES course(courseid)
        ON DELETE CASCADE,
    INDEX testing_id (testing_id),
    FOREIGN KEY (testing_id)
        REFERENCES testing(testingid)
        ON DELETE CASCADE,
    INDEX class_ind (class_id),
    FOREIGN KEY (class_id)
        REFERENCES course_class(classid)
        ON DELETE CASCADE
)ENGINE=INNODB;
		
create trigger ins_exam after insert on exam FOR EACH ROW BEGIN
  update testing set examnum = examnum + 1 where testingid = new.testing_id;
END;