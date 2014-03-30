#create database testDB1;
use testDB1;

CREATE TABLE customerHour (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	day DATE, 
	customer VARCHAR(20),  
	description TEXT, 
	hours INT(11), 
	offhours INT(11),
	deleted INT(1)
);


CREATE TABLE user (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16),
	password BINARY(32), #SHA-256 compatible
	firstname VARCHAR(32),
	lastname VARCHAR(32),
	address VARCHAR(128),
	email VARCHAR(254), #virallinen email max length 254
	phone VARCHAR(15), #onpahan tilaa kansainvälisille
	rank INT(1) NOT NULL #worker, manager?
);

#ilman kommentteja
CREATE TABLE user (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(16) NOT NULL,
	password BINARY(32) NOT NULL,  
	firstname VARCHAR(32),
	lastname VARCHAR(32),
	address VARCHAR(128),
	email VARCHAR(254), 
	phone VARCHAR(15), 
	rank INT(1) NOT NULL 
);

#välitaulu käyttäjälle ja asiakkaalta laskutettavilta tunneilta
CREATE TABLE customerHourWorkers(
	customerHour_id INT(11) NOT NULL,
	user_id int(11) NOT NULL,
	PRIMARY KEY(customerHour_id, user_id),
	FOREIGN KEY (user_id)
		REFERENCES user (id)
		ON DELETE CASCADE,
	FOREIGN KEY (customerHour_id)
		REFERENCES customerHour (id)
		ON DELETE CASCADE

);

CREATE TABLE workHour (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	day DATE, 
	hours INT(11),
	offhours INT(11),
	standbyhours INT(11),
	deleted INT(1),
	user_id INT(11),
	FOREIGN KEY (user_id)
		REFERENCES user (id)
		ON DELETE CASCADE
);