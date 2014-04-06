<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	


	public static function index() {
		if(isset($_GET['notice'])) {
			render('CustomerHours/index.php', array(
				'lista' => CustomerHours::get_all(),
				'notice' => $_GET['notice']
			));	
		} else {
			render('CustomerHours/index.php', array(
				'lista' => CustomerHours::get_all()				
			));	
		}
	}

	public static function create() {
		$day = in('post','day');		
		$customer = in('post','customer');
		$people = in('post','people');
		$description = in('post','description');
		$hours = in('post','hours');
		$offhours = in('post','offhours');

		if(!$hours) { $hours = '0'; }
		if(!$offhours) { $offhours = '0'; }

		if(!CustomerHoursController::validateParams($day, $customer, $people, $description, $hours, $offhours)){
			redirect('/hours/', array("notice", "create failed"));	
		} else {
			if(CustomerHours::add_hours($day, $customer, $people, $description, $hours, $offhours)){
				redirect('/hours/', array("notice", "create success"));	
			} else {
				redirect('/hours/', array("notice", "create failed"));			
			}			
		}
		
		
	}

	public static function destroy(){
		$id = in('post', 'hiddenID');
		$psswd = in('post', 'password');
		if(User::authenticate($_SESSION['user'],$psswd )){
			if(CustomerHours::delete_hour($id)){
				redirect('/hours/', array("notice", "destroy success"));	
			}		
		}
		redirect('/hours/', array("notice", "destroy failed"));			
	}

	public static function update(){
		$id = in('post', 'hiddenID');

		$day = in('post','day');		
		$customer = in('post','customer');
		$people = in('post','people');
		$description = in('post','description');
		$hours = in('post','hours');
		$offhours = in('post','offhours');
		
		$billed = in('post', 'billed');
		if($billed == 'true'){
			$billed = 1;
		} else {
			$billed = 0;
		}

		if(!CustomerHoursController::validateParams($day, $customer, $people, $description, $hours, $offhours)){
			redirect('/hours/', array("notice", "create failed"));	
		} else {
			$arr = array();
			if(CustomerHours::update_hour($id, $day, $customer, $people, $description, $hours, $offhours, $billed)){			
				redirect('/hours/', array("notice", "update success"));	
			} else {
				redirect('/hours/', array("notice", "update failed"));
			}				
		}
	
			
	}

	private static function validateParams($day, $customer, $people, $description, $hours, $offhours){
		if(empty($day) || empty($customer) || empty($people) || empty($description) || empty($hours) || empty($offhours)){
			return false;
		} else {
			return true;
		}
	}

}

?>