create table user_work_file(
	fileid int not null,
	userid int not null references user(userid),
	workid int not null references work(workid),
	savepath varchar(100) not null,
	savename varchar(100) not null,
	filename varchar(100) not null,
	filesize double not null,
	ext varchar(100) not null,
	creationtime datetime not null
);