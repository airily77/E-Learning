create table scrollimage(
	simgid int primary key not null auto_increment,
	image blob not null,
	img_name varchar(50) not null,
	img_type varchar(50) not null,
	img_size varchar(50) not null,
	title varchar(100) not null,
	isshow boolean not null,
	-- sortno ? 
	creationtime datetime not null,
	updatetime datetime not null
);