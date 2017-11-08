create table course_review(
	reviewid int primary key not null auto_increment,
	courseid int not null references course(courseid), 
	savepath varchar(100) not null,
	savename varchar(100) not null,
	filename varchar(100) not null,
	filesize int not null,
	ext varchar(100) not null,
	downloadnum int not null,
	creationtime datetime not null,
	updatetime datetime not null
);