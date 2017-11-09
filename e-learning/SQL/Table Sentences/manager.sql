CREATE TABLE manager(
	managerid int primary key not null AUTO_INCREMENT,
	account VARCHAR(50) UNIQUE not null,
  	password varchar(500) not null,
  	-- mkey ? Don't know what it does so not  	i'm not concluding it at this point.
  	status tinyint not null,
  	-- super ? Don't know what it does so not i'm not concluding it at this point.
  	creationtime datetime not null,
  	updatetime datetime null,
  	creationip varchar(20) not null,
  	lastlogintime datetime null,
  	lastloginip varchar(20) null,
  	loginnum int not null
  	-- isdelete ? Don't know what it does so not i'm not concluding it at this point.
);
DELIMITER |
create trigger ins_loginlog after insert on manager
for EACH ROW
	begin
	  insert into manager_loginlog (managerid,logintime,loginip) values (NEW.managerid,now(),new.creationip);
		insert into manager_role (managerid,roleid) values (new.managerid,1); -- chanage 1 to something else 
	END|

	-- insert into manager (account,password,status,creationtime,updatetime,lastlogintime,creationip,lastloginip,loginnum)
	-- values('accountname','password',3,now(),now(),now(),'127.0.0.1','127.0.0.1',1);