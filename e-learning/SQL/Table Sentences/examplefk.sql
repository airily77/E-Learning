CREATE TABLE  user (
    userid INT NOT NULL AUTO_INCREMENT,
    account varchar(50) not null unique,
    password varchar(500) not null,
    username VARCHAR(50) NULL,
  	department VARCHAR(50) null,
  	position VARCHAR(50) NULL,
  	status tinyint not null,
  	lastlogintime datetime not null,
  	lastloginip VARCHAR(20) not null,
  	loginnum int not null,
  	createtime datetime not null,
  	updatetime datetime not NULL,
    PRIMARY KEY (userid)
) ENGINE=INNODB;

CREATE TABLE user_loginlog (
    logid INT NOT NULL auto_increment,
    user_id INT not null,
    logintime datetime not null,
    loginip varchar(20) null,
    browser varchar(500) null,
    PRIMARY KEY (logid),
    INDEX user_ind (user_id),
    FOREIGN KEY (user_id)
        REFERENCES user(userid)
        ON DELETE CASCADE
) ENGINE=INNODB;