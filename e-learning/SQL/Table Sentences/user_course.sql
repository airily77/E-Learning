create table user_course(
	usercourseid int primary key not null auto_increment,
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
        ON DELETE CASCADE    
)ENGINE=INNODB;