create table testing(
	testingid int primary key not null auto_increment,
	coruseid int not null references course(courseid),
	totalscore int not null,
	passscore int not null,
	donenum int not null,
	creationtime datetime not null,
	updatetime datetime not null
);