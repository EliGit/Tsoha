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

	public static function add_hours() {
		global $db;

		$day = in('post','day');
		
		$customer = in('post','customer');

	//	if($customer == 'new') {
	//		$customer = in('post','new_customer');
	//	}
		$people = in('post','people');
		$description = in('post','description');
		$hours = in('post','hours');
		$offhours = in('post','offhours');
		
		if(!$hours) { $hours = '0'; }
		if(!$offhours) { $offhours = '0'; }
		$q = "INSERT INTO hour SET day='".$db->quote($day)."',customer='".$db->quote($customer)."',people='".$db->quote($people)."',description='".$db->quote($description)."',hours=".$db->quote($hours).",offhours=".$db->quote($offhours).",deleted=0";

		
		$db->insertQuery($q);

		
		header('Location: /hours/');
	}

	public static function render(){
		render('hours.php', array(
			'lista' => self::get_all()
		));
	}
}

?>