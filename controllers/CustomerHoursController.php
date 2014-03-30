<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	


	public static function index() {
		render('CustomerHours/index.php', array(
			'lista' => CustomerHours::get_all()
		));
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

		CustomerHours::add_hours($day, $customer, $people, $description, $hours, $offhours);
		redirect('/hours/');
		//TODO
		//renderöi notice: failure jos ei onnistunut lisääminen
	}

	public static function destroy(){

	}

	public static function update(){

	}
}

?>