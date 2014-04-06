<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	


	public static function index() {		
		render('CustomerHours/index.php', array(
			'lista' => CustomerHours::get_all(),
			"uparams" => array(date('Y-m-d'), "Customer's name", $_SESSION['user'], "Short description", null, null)
		));	
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

		CustomerHoursController::validateParams($day, $customer, $people, $description, $hours, $offhours);

		if(CustomerHours::add_hours($day, $customer, $people, $description, $hours, $offhours)){
			redirect('/hours/', array("notice", "create success"));	
		} 
		render('CustomerHours/index.php', array(
			"lista" => CustomerHours::get_all(),
			"notice" => "create failed, check input formats",
			"uparams" => array($day, $customer, $people, $description, $hours, $offhours))
		);
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
		
		CustomerHoursController::validateParams($day, $customer, $people, $description, $hours, $offhours);
					
		$arr = array();
		if(CustomerHours::update_hour($id, $day, $customer, $people, $description, $hours, $offhours, $billed)){			
			redirect('/hours/', array("notice", "update success"));	
		} 
		render('CustomerHours/index.php', array(
			"lista" => CustomerHours::get_all(),
			"notice" => "update failed, check input formats",
			"uparams" => array($day, $customer, $people, $description, $hours, $offhours))
		);
	}

	private static function validateParams($day, $customer, $people, $description, $hours, $offhours){
		if(empty($day) || !(preg_match('/^\d{4}-\d{2}-\d{2}/', $day))){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "invalid date!",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		}

		if(empty($customer)){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "no customer!",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		} 

		if(empty($people)){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "no workers!",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		}

		if(empty($description)){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "write a description!",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		}

		if(empty($hours) || !is_numeric($hours)){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "invalid hours",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		}

		if(empty($offhours) || !is_numeric($offhours)){
			render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => "invalid offhours",
				"uparams" => array($day, $customer, $people, $description, $hours, $offhours)
			));
		}	
	}
}

?>