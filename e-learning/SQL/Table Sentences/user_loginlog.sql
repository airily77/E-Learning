create table user_loginlog(
	logid int primary key not null AUTO_INCREMENT,
	userid int not null REFERENCES user(userid),
	logintime datetime not null,
	loginip varchar(20) null,
	result boolean null,
	browser varchar(500) null
	-- resume ?
);
DELIMITER $$
CREATE TRIGGER `update_logintime_user` AFTER INSERT ON `user_loginlog` FOR EACH ROW IF @disable_update_logintime_user IS NULL THEN
    update user set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where userid = new.userid;
  END IF
$$
DELIMITER;