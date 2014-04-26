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

	public function query($sql, $params){		
		$query = $this->getConn()->prepare($sql);
		$query->execute($params);

		
		//each row as array(column => row[col], col => row[col2])
		$tulokset = array();
		foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
			$tulokset[] = $result;
		}
		return $tulokset;
	}

	public function insertQuery($sql, $params){
		$query = $this->getConn()->prepare($sql);
		return $query->execute($params);
	}

	public function quote($str) {
		return $this->conn->quote($str);
	}


	public function latestID(){
		return $this->getConn()->lastInsertId();	
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