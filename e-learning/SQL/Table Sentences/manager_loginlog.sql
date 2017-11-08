create table manager_loginlog(
	logid int primary key not null AUTO_INCREMENT,
	managerid int not null REFERENCES manager(managerid),
	logintime datetime not null,
	loginip varchar(20) null,
	-- result ?
	browser varchar(500) null
	-- resume ?
);
insert into manager_loginlog (managerid,logintime,loginip,browser)
values (1,now(),'127.0.0.1','firefox');
-- insert into manager_loginlog (managerid,logintime,loginip,browser) values (1,now(),127.0.1,firefox)