create table article_attach(
	attachid int not null auto_increment,
	article_id int not null,
	savepath varchar(100) not null,
	savename varchar(100) not null,
	filename varchar(100) not null,
	filesize double not null,
	ext varchar(100) not null,
	downloadnum int not null,
	creationtime datetime not null,
	updatetime datetime null,
	primary key (attachid),
	INDEX article_ind (article_id),
    FOREIGN KEY (article_id)
        REFERENCES article(articleid)
        ON DELETE CASCADE
)ENGINE=INNODB;