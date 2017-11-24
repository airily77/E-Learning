create table user_work_file(
	fileid int not null,
	user_id int not null,
	work_id int not null,
	savepath varchar(100) not null,
	savename varchar(100) not null,
	filename varchar(100) not null,
	filesize double not null,
	ext varchar(100) not null,
	creationtime datetime not null,
	PRIMARY KEY (fileid),
	INDEX user_ind(user_id),
	FOREIGN KEY (user_id)
	REFERENCES user(userid)
		ON 	DELETE CASCADE,
	INDEX work_ind (work_id),
	FOREIGN KEY (work_id)
	REFERENCES work(workid)
		ON 	DELETE CASCADE
);