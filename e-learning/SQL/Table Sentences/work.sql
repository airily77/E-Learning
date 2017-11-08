create table work(
	workid int primary key not null auto_increment,
	title varchar(100) not null,
	description varchar(300) not null,
	classid int not null references course_class(classid), -- maybe course class_id
	type tinyint not null,
	courseid int not null references course(courseid),
	creationtime datetime not null,
	updatetime datetime not null
); 