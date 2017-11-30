create table work(
	workid int not null auto_increment,
	title varchar(100) not null,
	description varchar(300) not null,
	course_id int not null,
	type tinyint not null,
	class_id int not null,
	creationtime datetime not null,
	updatetime datetime not null,
	primary key (workid),
	INDEX course_ind (course_id),
	FOREIGN KEY (course_id)
	REFERENCES course(courseid)
		ON 	DELETE CASCADE,
	INDEX class_ind (class_id),
	FOREIGN KEY (class_id)
	REFERENCES course_class(classid)
		ON 	DELETE CASCADE
); 