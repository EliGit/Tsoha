CREATE TABLE hour (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	day DATE, 
	customer VARCHAR(20), 
	people VARCHAR(20), 
	description TEXT, 
	hours INT(11), 
	offhours INT(11),
	deleted INT(1));






INSERT INTO hour SET day=2014-01-01, customer="Le Company", people="Jari, Kalle", description= "alles gut", hours=5, offhours=2, deleted=0;