<?php
class WorkHour{

	public static function getUsersStats() {
		global $db;
		$sql = "SELECT 
					user.username, 
					sum(workHour.hours) thours, 
					sum(workHour.offhours) toffhours, 
					sum(workHour.standbyhours) tstandbyhours
				FROM user 
				LEFT JOIN workHour ON 
					user.username=workHour.username 
				WHERE workHour.approved=1
				GROUP BY user.username";
		return $db->query($sql, null); //no params
	}

	public static function getUsersWorkHours($user, $month) {
		global $db;
		if(empty($month)){
			$sql = "SELECT * FROM workHour WHERE username=? AND approved='0'";
			
		} else {
			$first = strtotime($month);
			$last = strtotime($month . '+ 1 month - 1 second');
			//month has been whitelisted with regex - only YYYY-MM where Y and M are digits are allowed
			$sql = "SELECT * FROM workHour WHERE username=? AND day BETWEEN FROM_UNIXTIME($first) AND FROM_UNIXTIME($last)";			
		}
		
		$params = array($user);

		
		return $db->query($sql, $params);
	}

	public static function add_hour($day, $hours, $offhours, $standbyhours, $username) {
		global $db;

		$q = "INSERT INTO workHour SET day=?,hours=?,offhours=?,standbyhours=?,username=?,approved=0";
		$params = array($day, $hours, $offhours, $standbyhours, $username);

		return $db->insertQuery($q, $params);
	}

	
	public static function delete_hour($id, $user){
		global $db;
		$q = "DELETE FROM workHour WHERE id=? AND username=?";
		$params = array($id, $user);
		return $db->insertQuery($q, $params);
	}


	public static function update_hour($id, $day, $hours, $offhours, $standbyhours, $username){
		global $db;
		
		$q = "UPDATE workHour SET day=?,hours=?,offhours=?,standbyhours=? WHERE username=? AND id=?";
		$params = array($day, $hours, $offhours, $standbyhours, $username, $id);

		return $db->insertQuery($q, $params);
	}

	public static function approveUsersHours($user){
		global $db;
		$q = "UPDATE workHour SET approved=1 WHERE username=?";
		$params = array($user);

		return $db->insertQuery($q, $params);

	}
}
?>