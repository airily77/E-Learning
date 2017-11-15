create table user_testing(
	usertestingid int not null auto_increment,
	user_id int not null,
	testing_id int not null,
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