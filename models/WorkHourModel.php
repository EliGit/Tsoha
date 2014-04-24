<?php
class WorkHour{

	public static function get_all() {
	
	}

	public static function getUsersWorkHours($user) {
		global $db;
		$q = "Select * from workHour where username=" . $db->quote($user);
		return $db->query($q);
	}

	public static function add_hour($day, $hours, $offhours, $standbyhours, $username) {
		global $db;
		$q = "INSERT INTO workHour SET day=".$db->quote($day)
										   	.",hours=".$db->quote($hours)
											.",offhours=".$db->quote($offhours)
											.",standbyhours=".$db->quote($standbyhours)
											.",username=".$db->quote($username);
		return $db->insertQuery($q);		
	}

	
	public static function delete_hour($id){
		global $db;
		$q = "DELETE FROM workHour WHERE id=$id";
		return $db->insertQuery($q);
	}


	public static function update_hour($id, $day, $hours, $offhours, $standbyhours, $username){
		global $db;
		$q = "UPDATE workHour SET day=".$db->quote($day)
									   	.",hours=".$db->quote($hours)
										.",offhours=".$db->quote($offhours)
										.",standbyhours=".$db->quote($standbyhours)
										.",username=".$db->quote($username)
										." WHERE id=$id";
		return $db->insertQuery($q);
	}
}
?>