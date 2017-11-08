create table config(
	configid int primary key not null auto_increment,
	configtype varchar(50) not null,
	configname varchar(50) not null,
	configkey varchar(50) not null
);