create table article_attach(
	attachid int primary key not null auto_increment,
	arcid int not null references article(arcid),
	savepath varchar(100) not null,
	savename varchar(100) not null,
	filename varchar(100) not null,
	filesize double not null,
	ext varchar(100) not null,
	downloadnum int not null,
	creationtime datetime not null,
	updatetime datetime null
);