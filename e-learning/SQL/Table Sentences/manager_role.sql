create table manager_role(
	manager_id INT not null,
	role_id INT not null,
	INDEX manager_ind (manager_id),
    FOREIGN KEY (manager_id)
        REFERENCES manager(managerid)
        ON DELETE CASCADE,
    INDEX role_ind (role_id),
    FOREIGN KEY (role_id)
        REFERENCES role(roleid)
        ON DELETE CASCADE
)ENGINE=InnoDB;
