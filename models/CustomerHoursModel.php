<?php
class CustomerHours{

	public static function get_all() {
		global $db;
		$sql = "SELECT * FROM customerHour";

		$hours = $db->query($sql, null); //no params

		$sql = "SELECT * FROM customerHourWorkers";
		$workers = $db->query($sql, null); //no params

		//add workers to their corresponding customerHour
		foreach ($hours as &$h) {
			$h['people']=array();
			foreach ($workers as $w) {
				if($w['customerHour_id']==$h['id']){
					$h['people'][] = $w['user_id'];					
				}					
			}
		}
		return $hours;
	}

	public static function create_hour($day, $customer, $people, $description, $hours, $offhours) {
		global $db;
		
		//validate people
		$users = CustomerHours::validatePeople($people);
		if($users==false) return false;


		//create customerHour entry
		$q = "INSERT INTO customerHour SET day=?,customer=?,description=?,hours=?,offhours=?,billed='0'";
		$params = array($day, $customer, $description, $hours, $offhours);
		$db->insertQuery($q, $params);
		
		
		//create customerHourWorker entries		
		return CustomerHours::addWorkHourUsers($users, $db->latestID());
	}

	

	public static function delete_hour($id){
		global $db;
		$q = "DELETE FROM customerHour WHERE id=?";
		$params = array($id);
		return $db->insertQuery($q, $params);
	}



	public static function update_hour($id, $day, $customer, $people, $description, $hours, $offhours, $billed){
		global $db;

		//validate people
		$users = CustomerHours::validatePeople($people);
		if($users==false) return false;
		

		//find current workers
		$sql = "SELECT user_id FROM customerHourWorkers WHERE customerHour_id=?";
		$params = array($id);
		$workers = $db->query($sql, $params);

		//add workers to customerHour if needed
		foreach ($users as $u) {
			if(!in_array( array("user_id" => $u), $workers)){
				if(!CustomerHours::addWorkHourUsers(array($u), $id)){
					return false;
				}
			}
		}

		//remove workers from customerHour if needed
		foreach ($workers as $w) {
			if(!in_array($w['user_id'], $users)){				
				$sql = "DELETE FROM customerHourWorkers WHERE customerHour_id=? AND user_id=?";
				$params = array($id, $w['user_id']);
				$bool = $db->insertQuery($sql, $params);
			}
		}

		//update customerHour normally
		$q = "UPDATE customerHour SET day=?,customer=?,description=?,hours=?,offhours=?,billed=? WHERE id=?";
		$params = array($day, $customer, $description, $hours, $offhours, $billed, $id);
		return $db->insertQuery($q, $params);
	}

	//allowUpdate only if user is a worker in specified customerHour(ID)
	public static function allowUpdate($user, $customerHourID){
		global $db;

		$q = "select 1 from customerHourWorkers WHERE customerHour_id=? AND user_id=? LIMIT 1";
		$params = array($customerHourID, $user);

		$result = $db->query($q, $params);
		
		return count($result)==1;
	}

	/*
	*	HELPERS
	*/
	private static function validatePeople($people){

		$users = explode(",", $people);
		$users_in_db = User::getUserNames();

		foreach ($users as $u) {
			//users_in_db must contain "username"=>$u (query result of the form array("col" => "row[col]"...))
			if(!in_array(array("username"=>$u), $users_in_db, true)){
				return false;
			}
		}
		return $users;
	}	

	private static function addWorkHourUsers($users, $id){
		global $db;

		foreach ($users as $u) {			
			$q = "INSERT INTO customerHourWorkers SET customerHour_id=?,user_id=?";
			$params = array($id, $u);
			if(!$db->insertQuery($q, $params)){
				return false;
			}
		}
		return true;
	}

}


?>