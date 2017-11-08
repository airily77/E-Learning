create table article(
	arcid int primary key not null auto_increment,
	title varchar(100) not null,
	content longtext not null,
	classid int not null references article_class(classid),
	thumbimage varchar(100) null,
	source varchar(200) null,
	keyword varchar(100) null,
	tags varchar(100) null,
	status boolean not null,
	clicknum int not null,
	creationtime datetime not null,
	updatetime null
);