<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	


	public static function index() {		
		render('CustomerHours/index.php', array(
			'notice' => $_GET['notice'],
			'lista' => CustomerHours::get_all(),
			"uparams" => array(date('Y-m-d'), "Customer's name", $_SESSION['user'], "Short description", null, null)
		));	
	}
	

	public static function create() {
		$day = in('post','day');		
		$customer = htmlspecialchars(in('post','customer'));
		$people = htmlspecialchars(in('post','people'));
		$description = htmlspecialchars(in('post','description'));
		$hours = in('post','hours');
		$offhours = in('post','offhours');

		if(!$hours) { $hours = '0'; }
		if(!$offhours) { $offhours = '0'; }

		CustomerHoursController::validateParams($day, $customer, $people, $description, $hours, $offhours);

		if(CustomerHours::add_hours($day, $customer, $people, $description, $hours, $offhours)){
			redirect('/hours/', array("notice", "create success"));	
		} 
		CustomerHoursController::render(array($day, $customer, $people, $description, $hours, $offhours), "create failed, check input formats");
	}

	public static function destroy(){
		$id = in('post', 'hiddenID');
		$psswd = in('post', 'password');
		if(User::authenticate($_SESSION['user'],$psswd )){
			if(CustomerHours::delete_hour($id)){
				redirect('/hours/', array("notice", "destroy success"));	
			}		
		}
		CustomerHoursController::render(array(date('Y-m-d'), "Customer's name", $_SESSION['user'], "Short description", null, null), "destroy failed, check password!");		
	}

	public static function update(){
		$id = htmlspecialchars(in('post', 'hiddenID'));
		$day = in('post','day');		
		$customer = htmlspecialchars(in('post','customer'));
		$people = htmlspecialchars(in('post','people'));
		$description = htmlspecialchars(in('post','description'));
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
		CustomerHoursController::render(array($day, $customer, $people, $description, $hours, $offhours), "update failed, check input formats");
	}

	private static function validateParams($day, $customer, $people, $description, $hours, $offhours){
		$uparams = array($day, $customer, $people, $description, $hours, $offhours);
		if(empty($day) || !(preg_match('/^\d{4}-\d{2}-\d{2}/', $day))){
			CustomerHoursController::render($uparams, "invalid date!");
		}
		if(empty($customer)){
			CustomerHoursController::render($uparams, "no customer!");
		} 
		if(empty($people)){
			CustomerHoursController::render($uparams, "no workers!");
		}
		if(empty($description)){
			CustomerHoursController::render($uparams, "write a description!");
		}
		if((empty($hours) && $hours!=0) || !is_numeric($hours)){
			CustomerHoursController::render($uparams, "invalid hours!");
		}
		if((empty($offhours) && $offhours!=0) || !is_numeric($offhours)){
			CustomerHoursController::render($uparams, "invalid offhours!");
		}	
	}

	private static function render($uparams, $notice){
		render('CustomerHours/index.php', array(
				"lista" => CustomerHours::get_all(),
				"notice" => $notice,
				"uparams" => $uparams
			));
	}
}

?>