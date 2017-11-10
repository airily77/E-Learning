create table user (
  userid int PRIMARY KEY AUTO_INCREMENT not null,
  account VARCHAR(50) not null unique ,
  password varchar(50) not null,
  username VARCHAR(50) NULL,
  department VARCHAR(50) null,
  position VARCHAR(50) NULL,
  status tinyint not null,
  lastlogintime datetime not null,
  lastloginip VARCHAR(20) not null,
  loginnum int not null,
  createtime datetime not null,
  updatetime datetime not null
);

insert into user (account,password,username,ukey,status,lastlogintime,lastloginip,loginnum,createtime,updatetime)
values('test','test','test','test',2,10.30,"127.0.0.1",1,12.57,12.57);