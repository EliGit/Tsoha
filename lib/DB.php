<?php

require 'CONFIG.php';
class DB{
	//Tietokannan tunnukset:
	private	$user = Config::DB_USER;
	private	$passwd = Config::DB_PASSWORD;
	private $host = Config::DB_HOST;
	private $dbname = Config::DB_DATABASE;
	private $conn;

	public function __construct() {
		//open connection
		$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;",
								$this->user,
								$this->passwd);

		//PDO error reporting
		$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	public function getConn(){
		return $this->conn;
	}

	public function query($sql){		
		$query = $db->getConn()->prepare($sql);
		$query->execute();

		$tulokset = array();
		foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
			$tulokset[] = $result;
		}
		return $tulokset;
	}

	public function insertQuery($sql){
		$query = $this->getConn()->prepare($sql);
		$query->execute();
	}

	public function quote($str) {
		return mysql_real_escape_string($str);
	}


/*
	public function query_hash($q) {
		$r = $this->query($q);
		$arr = array();
		while($row = $r->fetchArray()) {
			array_push($arr,$row);
		}
		return $arr;		
	}
*/

}