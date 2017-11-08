create table activity(
	activityid int not null primary key auto_increment,
	title varchar(100) not null,
	content longtext not null,
	signendtime int not null,
	creationtime datetime not null,
	updatetime datetime not null
);