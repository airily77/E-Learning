create table user_testing(
	usertestingid int not null,
	userid int not null references user(userid),
	testingid int not null references testing(testingid),
	status boolean not null,
	rightexam int not null, -- ? 
	wrongexam int not null, -- ?
	gotscore int not null, 
	completetime int(10) not null	
);