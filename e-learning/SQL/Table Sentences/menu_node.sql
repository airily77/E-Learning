create table menu_node(
	nodeid int primary key not null auto_increment,
	nodename varchar(50) not null,
	control varchar(50) not null,
	action varchar(50) not null,
	--pnodeid ? 
	groupid int not null references menugroup(groupid),
	show boolean not null,
	creationtime datetime not null,
	updatetime datetime null
);