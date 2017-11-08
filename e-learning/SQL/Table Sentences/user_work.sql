create table user_work(
	userworkid int primary key not null auto_increment,
	userid int not null references user(userid),
	workid int not null references work(workid),
	status boolean not null,
	completetime int not null
);