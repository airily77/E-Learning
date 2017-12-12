create table manager_loginlog(
	logid int not null AUTO_INCREMENT,
	manager_id INT not null,
	logintime datetime not null,
	loginip varchar(20) null,
	result boolean null,
	browser varchar(500) NULL,
	PRIMARY KEY (logid),
	INDEX manager_ind (manager_id),
    FOREIGN KEY (manager_id)
        REFERENCES manager(managerid)
        ON DELETE CASCADE
)ENGINE=InnoDB;
CREATE TRIGGER `update_logintime` AFTER INSERT ON `manager_loginlog` FOR EACH ROW BEGIN
  IF @disable_update_logintime IS NULL THEN
  update manager set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where managerid = new.manager_id;
END IF;
END;
-- insert into manager_loginlog (managerid,logintime,loginip,browser) values (1,now(),127.0.1,firefox)