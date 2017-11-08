create table user_testing_result(
	userid int not null references user(userid),
	testingid int not null references testing(testingid),
	examid int not null references exam(examid),
	useranswer varchar(100) not null,
	officeanswer varchar(100) not null,
	result boolean not null
);