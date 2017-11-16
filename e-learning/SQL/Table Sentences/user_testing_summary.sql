create table user_testing_summary(
	usertestingsummary int not null auto_increment,
	user_id int not null,
	medianscore double not null,
	bestscore double not null
	--//TODO Maybe if you don't have anything else todo. You can summary everything that the student has done.
);