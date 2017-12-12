create table article(
	articleid int not null auto_increment,
	title varchar(100) not null unique,
	content longtext not null,
	article_class varchar(50) null,
	thumbimage varchar(100) null,
	source varchar(200) null,
	keyword varchar(100) null,
	tags varchar(100) null,
	status boolean not null,
	clicknum int not null,
	creationtime datetime not null,
	updatetime datetime null,
	primary key(articleid)
)ENGINE=INNODB;