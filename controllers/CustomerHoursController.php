<?php
require './models/CustomerHoursModel.php';
class CustomerHoursController{
	
	//"CONST"
	private static function DEFAULTPARAMS() {
		return array('day' => date('Y-m-d'), 'customer' => "Customer's name", 'people' => $_SESSION['user'], 
					'description' => "Short description",'hours' => 0,'offhours'=> 0);
	}
	
   /*
   	*	INDEX
  	*/
	public static function index() {		
		render('CustomerHours/index.php', array(
			'notice' => $_GET['notice'],
			'lista' => CustomerHours::get_all(),
			"uparams" => CustomerHoursController::DEFAULTPARAMS()
		));	
	}
	
   /*
   	*	CREATE 
  	*/
	public static function create() {
		$p = CustomerHoursController::params();

		CustomerHoursController::validateParams($p);

		if(CustomerHours::add_hours($p['day'], $p['customer'], $p['people'], $p['description'], $p['hours'], $p['offhours'])){
			redirect('/hours/', array("notice" => "create success"));	
		} 
		CustomerHoursController::render(CustomerHoursController::DEFAULTPARAMS(), "rejected create, check users and inputs");
	}

   /*
   	*	DESTROY
  	*/
	public static function destroy(){
		if($_SESSION['rank']!=1) {
			exit;	
		}
		$id = in('post', 'hiddenID');
		$psswd = in('post', 'password');
		if(User::authenticate($_SESSION['user'],$psswd )){
			if(CustomerHours::delete_hour($id)){
				redirect('/hours/', array("notice" => "destroy success"));	
			}		
		}
		CustomerHoursController::render(array(date('Y-m-d'), "Customer's name", $_SESSION['user'], "Short description", null, null), "destroy failed, check password!");
	}


   /*
   	*	UPDATE
  	*/

	public static function update(){
		$id = htmlspecialchars(in('post', 'hiddenID'));

		//allow update only if user is a worker in this customerHour
		if(!CustomerHours::allowUpdate($_SESSION['user'], $id) && $_SESSION['rank']!=1){
			CustomerHoursController::render(CustomerHoursController::DEFAULTPARAMS(),"you are not allowed to update this customerHour as you are not a worker in it!");
		}

		$p = CustomerHoursController::params();
		
		$billed = in('post', 'billed');
		if($billed == 'true'){
			$billed = 1;
		} else {
			$billed = 0;
		}
		
		CustomerHoursController::validateParams($p);


					
		$arr = array();
		if(CustomerHours::update_hour($id, $p['day'], $p['customer'], $p['people'], $p['description'], $p['hours'], $p['offhours'], $billed)){			
			redirect('/hours/', array("notice" =>"update success"));	
		} 
		CustomerHoursController::render(CustomerHoursController::DEFAULTPARAMS(),"update failed, check input formats");
	}

   /*
	*   PRIVATES
	*/

	private static function params() {
		$day = in('post','day');		
		$customer = htmlspecialchars(in('post','customer'));
		$people = htmlspecialchars(in('post','people'));
		$description = htmlspecialchars(in('post','description'));
		$hours = in('post','hours');
		$offhours = in('post','offhours');

		if(!$hours) { $hours = '0'; }
		if(!$offhours) { $offhours = '0'; }

		return array("day" => $day, "customer" => $customer, "people" => $people,
					 "description"=> $description, "hours" => $hours, "offhours" => $offhours);
	}

	private static function validateParams($p){

		if(empty($p['day']) || !(preg_match('/^\d{4}-\d{2}-\d{2}/', $p['day']))){
			CustomerHoursController::render($p, "invalid date!");
		}
		if(empty($p['customer'])){
			CustomerHoursController::render($p, "no customer!");
		} 
		if(empty($p['people'])){
			CustomerHoursController::render($p, "no workers!");
		}
		if(empty($p['description'])){
			CustomerHoursController::render($p, "write a description!");
		}
		if(!is_numeric($p['hours']) || $p['hours']>9){
			CustomerHoursController::render($p, "invalid hours!");
		}
		if(!is_numeric($p['offhours']) || $p['offhours']>15){
			CustomerHoursController::render($p, "invalid offhours!");
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