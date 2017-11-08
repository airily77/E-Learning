create table scrollimage(
	simgid int primary key not null auto_increment,
	simgpath varchar(100) not null,
	title varchar(100) not null,
	link varchar(100) null,
	isshow boolean not null,
	-- sortno ? 
	creationtime datetime not null,
	updatetime datetime not null
);