CREATE TABLE user_loginlog (
    logid INT NOT NULL auto_increment,
    user_id INT not null,
    logintime datetime not null,
    loginip varchar(20) null,
    browser varchar(500) null,
    result boolean not null,
    PRIMARY KEY (logid),
    INDEX user_ind (user_id),
    FOREIGN KEY (user_id)
        REFERENCES user(userid)
        ON DELETE CASCADE
) ENGINE=INNODB;

DELIMITER $$
CREATE TRIGGER `update_logintime_user` AFTER INSERT ON `user_loginlog` FOR EACH ROW IF @disable_update_logintime_user IS NULL THEN
    update user set lastlogintime = NEW.logintime,lastloginip = new.loginip, loginnum = loginnum + 1 where userid = new.userid;
  END IF
$$
DELIMITER;