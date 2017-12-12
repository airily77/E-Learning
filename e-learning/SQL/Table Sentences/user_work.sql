create table user_work(
	userworkid int not null auto_increment,
	user_id int not null,
	work_id int not null,
	status boolean not null,
	completetime int not null,
	primary key (userworkid),
	INDEX user_ind(user_id),
	FOREIGN KEY (user_id)
	REFERENCES user(userid)
		ON 	DELETE CASCADE,
	INDEX work_ind(work_id),
	FOREIGN KEY (work_id)
	REFERENCES work(workid)
		ON 	DELETE CASCADE
);