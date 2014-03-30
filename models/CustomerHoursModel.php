<?php
class CustomerHours{


	public static function get_all() {
		global $db;
		$sql = "SELECT * FROM hour";
		$query = $db->getConn()->prepare($sql);
		$query->execute();

		$tulokset = array();
		foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
			$tulokset[] = $result;
		}

		return $tulokset;
	}

	public static function add_hours($day, $customer, $people, $description, $hours, $offhours) {
		global $db;
		
		$q = "INSERT INTO hour SET day='"
				.$db->quote($day)."',customer='".$db->quote($customer)
				."',people='".$db->quote($people)."',description='".$db->quote($description)
				."',hours=".$db->quote($hours).",offhours=".$db->quote($offhours).",deleted=0";

		$db->insertQuery($q);
	}

}


?>