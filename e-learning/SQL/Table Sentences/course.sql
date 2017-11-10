create table course(
	courseid int primary key not null auto_increment,
	title varchar(100) not null,
	description varchar(500) null,
	videoimg varchar(100) not null,
	videopath varchar(100) not null,
	videotime int not null,
	showimg varchar(100) not null,
	classid int not null references course_class(classid),
	viewnum int not null, -- Remember to do this when the page is completed. 
	learnnum int not null,
	istesting boolean not null,
	isshow boolean not null,
	creationtime datetime not null,
	updatetime datetime not null
);