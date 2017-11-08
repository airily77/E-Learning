create table activity_user(
	relativeid int not null references testing_exam(relativeid),
	activityid int not null references activity(activityid),
	userid int not null references user(userid),
	signtime datetime not null,
	remark varchar(500) not null
);