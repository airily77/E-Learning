create table testing(
	testingid int not null auto_increment,
	course_id INT NOT NULL,
	donenum int not null, -- counter for how many exams have been done
	examnum int not null, -- counter for how many exams are in one course
	medianpoints double null,
	creationtime datetime not null,
	updatetime datetime not null,
	PRIMARY KEY (testingid),
	INDEX course_ind (course_id),
    FOREIGN KEY (course_id)
        REFERENCES course(courseid)
        ON DELETE CASCADE
)ENGINE=INNODB;