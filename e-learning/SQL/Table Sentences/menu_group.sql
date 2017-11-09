create table menu_group(
	groupid int primary key not null auto_increment,
	groupname varchar(50) not null,
	control varchar(50) not null,
	action varchar(50) not null,
	show boolean not null, -- original was tinyint but the purpose is for yes or no so i think boolean is the better choice here
	icon varchar(500) not null,
	creationtime datetime not null,
	updatetime datetime not null
);