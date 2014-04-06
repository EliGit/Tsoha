<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	


	public static function index() {
		if(isset($_GET['update'])) {
			render('CustomerHours/index.php', array(
				'lista' => CustomerHours::get_all(),
				'notice' => "update ".$_GET['update']
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
	//	if($customer == 'new') {
	//		$customer = in('post','new_customer');
	//	}
		$people = in('post','people');
		$description = in('post','description');
		$hours = in('post','hours');
		$offhours = in('post','offhours');

		if(!$hours) { $hours = '0'; }
		if(!$offhours) { $offhours = '0'; }

		if(CustomerHours::add_hours($day, $customer, $people, $description, $hours, $offhours)){
			redirect('/hours/', array("update", "success"));	
		}
		redirect('/hours/', array("update", "failed"));	
		
	}

	public static function destroy(){
		$id = in('post', 'hiddenID');
		CustomerHours::delete_hour($id);
		redirect('/hours/');
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

		//echo "update following: " .$id." ".$day." ".$customer." ".$people." ".$description." ".$hours." ".$offhours." ".$billed;
		$arr = array();
		if(CustomerHours::update_hour($id, $day, $customer, $people, $description, $hours, $offhours, $billed)){			
			redirect('/hours/', array("update", "success"));	
		} else {
			redirect('/hours/', array("update", "failed"));
		}
		
	}
}

?>