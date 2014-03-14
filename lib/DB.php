<?php

class DB{
	//Tietokannan tunnukset:
	private	$user = "root";
	private	$passwd = "qwerty";
	private $conn;

	public function __construct() {
		//open connection
		$this->conn = new PDO("mysql:host=127.0.0.1;port=8889;dbname=tsoha",
								$this->user,
								$this->passwd);

		//PDO error reporting
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	public function getConn(){
		return $this->conn;
	}


}