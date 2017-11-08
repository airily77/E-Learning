create table role_node(
	roleid int not null references role(roleid),
	groupid int not null references menu_group(groupid),
	nodeid int not null references menu_node(nodeid)
);