create table exam_option(
	optionid int primary key not null auto_increment,
	examid int not null references exam(examid),
	name varchar(10) not null,
	title varchar(100) not null,
	updatetime datetime not null
);