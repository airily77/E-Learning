create table manager_loginlog(
	logid int primary key not null AUTO_INCREMENT,
	managerid int not null REFERENCES manager(managerid),
	logintime datetime not null,
	loginip varchar(20) null,
	result boolean null,
	browser varchar(500) null
	-- resume ?
);
CREATE TRIGGER `update_logintime` AFTER INSERT ON `manager_loginlog` FOR EACH ROW IF @disable_update_logintime IS NULL THEN
    update manager set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where managerid = new.managerid;
  END IF
-- insert into manager_loginlog (managerid,logintime,loginip,browser) values (1,now(),127.0.1,firefox)