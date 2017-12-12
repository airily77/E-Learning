create table course_class(
	classid int not null auto_increment,
	classname varchar(50) not null unique,
	status boolean not null,
	creationtime datetime not null,
	updatetime datetime not null,
	PRIMARY KEY (classid)
)ENGINE=INNODB;

-- TODO When someone inserts a course define classid by classname. Ask the manager to give name of the class to which it will be used to get the right classid.
