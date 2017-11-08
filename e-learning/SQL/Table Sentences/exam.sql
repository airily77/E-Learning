create table exam(
	examid int not null primary key auto_increment,
	type tinyint not null, --?
	title varchar(100) not null,
	answer varhcar(100) not null,
	creationtime datetime not null,
	updatetime datetime not null
);