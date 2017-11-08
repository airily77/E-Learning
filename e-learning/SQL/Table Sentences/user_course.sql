create table user_course(
	usercourseid int primary key not null auto_increment,
	userid int not null references user(userid),
	courseid int not null references course(courseid),
	status boolean not null,
	begintime datetime not null,
	completetime datetime not null
);