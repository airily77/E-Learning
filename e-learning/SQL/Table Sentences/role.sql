create table role(
	roleid int not null auto_increment,
	rolename varchar(50) not null,
	creationtime datetime not null,
	updatetime datetime not null,
	PRIMARY KEY (roleid)
)ENGINE=INNODB;