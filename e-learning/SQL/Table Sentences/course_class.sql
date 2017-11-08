create table course_class(
	classid int primary key not null auto_increment,
	classname varchar(50) not null,
	status boolean not null,
	creationtime datetime not null,
	updatetime datetime not null
);