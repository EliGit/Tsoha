<?php
require './models/WorkHourModel.php';
class WorkHoursController{
  
  	public static function index(){
	    
  	}

   /*
   	*	CREATE 
  	*/
  	public static function create() {
  		$p = WorkHoursController::params();
		WorkHoursController::validateParams($p);

        if(WorkHour::add_hour($p['day'], $p['hour1'], $p['hour2'], $p['hour3'], $p['usr'])){
        	redirect("/users/1", array("notice", "created successfully"));	
        }
        WorkHoursController::render(array($d, $h1, $h2, $h3, $u), "something went wrong in db");
    }

   /*
   	*	UPDATE
  	*/
	public static function update() {
		$id = in('post', 'hiddenID');
		
		$p = WorkHoursController::params();
		WorkHoursController::validateParams($p);

        WorkHour::update_hour($id, $p['day'], $p['hour1'], $p['hour2'], $p['hour3'], $p['usr']);
        redirect('/users/1', array("notice", "update success"));	
	}

   /*
   	*	DESTROY
  	*/
	public static function destroy() {
		$id = in('post', 'hiddenID');
		
		if(WorkHour::delete_hour($id)) {
			redirect('/users/1', array("notice", "destroy success"));
		}
	}

   /*
   	*	PRIVATES
  	*/

	private static function params() {
		$d = in('post', 'day');
        $h1 = in('post', 'hours');
        $h2 = in('post', 'offhours');
        $h3 = in('post', 'standbyhours');
        $u = $_SESSION['user'];

        return array("day" => $d, "hour1" => $h1, "hour2" => $h2,"hour3" => $h3, "usr" => $u);
	}

	private static function validateParams($p){
		$uparams = array($d, $h1, $h2, $h3, $u);


		if(empty($p['day']) || !(preg_match('/^\d{4}-\d{2}-\d{2}/', $p['day']))){
			WorkHoursController::render($uparams, "invalid date!");
		}

		if(empty($p['hour1']) || !is_numeric($p['hour1'])){
			WorkHoursController::render($uparams, "invalid hours 6-22!");
		}

		if(empty($p['hour2']) || !is_numeric($p['hour2'])){
			WorkHoursController::render($uparams, "invalid hours 22-6!");
		}

		if(empty($p['hour3']) || !is_numeric($p['hour3']) || $p['hour3']>24){
			WorkHoursController::render($uparams, "invalid hours standby!");
		}

		if($p['hour1']>16) {WorkHoursController::render($uparams, "hours 6-22 should not be more than 16");}
		if($p['hour2']>8) {WorkHoursController::render($uparams, "hours 6-22 should not be more than 8");}
	}

	private static function render($uparams, $notice){
		$workHours = WorkHour::getUsersWorkHours($_SESSION["user"]);
		render('Users/show.php', array(
	            "lista" => $workHours,
	            "notice" => $notice,
	            "uparams" => $uparams
	        ));
	}
}?>