create table testing_exam(
	relativeid int primary key not null auto_increment,
	testingid int not null references testing(testingid),
	examid int not null references exam(examid),
	score int not null,
	sortno int not null
);