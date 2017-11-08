create table manager_role(
	managerid int not null references manager(managerid),
	roleid int not null references role(roleid)
);