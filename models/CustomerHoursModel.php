<?php
//require './models/UserModel.php';
class CustomerHours{

	private static function validatePeople($people){
		if(empty($people)) return array();

		$users = explode(",", $people);
		$users_in_db = User::getUserNames();

		foreach ($users as $u) {
			if(!in_array(array("username"=>$u), $users_in_db, true)){
				return false;
			}
		}

		return $users;
	}

	private static function addWorkHourUsers($users, $id){

		global $db;

		

		foreach ($users as $u) {
			//echo "INSERT INTO customerHourWorkers SET customerHour_id='".$db->quote($id)."',user_id='".$db->quote($u)."'";
			$q = "INSERT INTO customerHourWorkers SET customerHour_id=".$db->quote($id).",user_id=".$db->quote($u);
			if(!$db->insertQuery($q)){
				return false;
			}
		}
		return true;
	}

	public static function get_all() {
		global $db;
		$sql = "SELECT * FROM customerHour";

		$hours = $db->query($sql);

		$sql = "SELECT * FROM customerHourWorkers";
		$workers = $db->query($sql);

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

	public static function add_hours($day, $customer, $people, $description, $hours, $offhours) {
		global $db;
		
		//validate people
		$users = CustomerHours::validatePeople($people);
		if($users==false) return false;


		//create customerHour entry
		$q = "INSERT INTO customerHour SET day="
				.$db->quote($day).",customer=".$db->quote($customer)
				.",description=".$db->quote($description)
				.",hours=".$db->quote($hours).",offhours=".$db->quote($offhours).",billed='0'";
		$db->insertQuery($q);
		
		
		//create customerHourWorker entries		
		return CustomerHours::addWorkHourUsers($users, $db->latestID());
	}

	

	public static function delete_hour($id){
		global $db;
		$q = "DELETE FROM customerHour WHERE id=$id";
		return $db->insertQuery($q);
	}



	public static function update_hour($id, $day, $customer, $people, $description, $hours, $offhours, $billed){
		global $db;

		//validate people
		$users = CustomerHours::validatePeople($people);
		if($users==false) return false;
		

		//find current workers
		$sql = "SELECT user_id FROM customerHourWorkers WHERE customerHour_id=".$db->quote($id);
		$workers = $db->query($sql);

		//add if needed
		foreach ($users as $u) {
			if(!in_array( array("user_id" => $u), $workers)){
				if(!CustomerHours::addWorkHourUsers(array($u), $id)){
					return false;
				}
			}
		}

		//remove if needed
		foreach ($workers as $w) {
			if(!in_array($w['user_id'], $users)){				
				$sql = "DELETE FROM customerHourWorkers WHERE customerHour_id=".$db->quote($id)." AND user_id=" . $db->quote($w['user_id']);
				$bool = $db->insertQuery($sql);
			}
		}

		//update customerHour normally
		$q = "UPDATE customerHour SET day=".$db->quote($day).",customer=".$db->quote($customer)
				.",description=".$db->quote($description)
				.",hours=".$db->quote($hours).",offhours=".$db->quote($offhours).",billed=".$db->quote($billed)
				." WHERE id=".$db->quote($id);
		return $db->insertQuery($q);
	}

}


?>