<?php
require './models/WorkHourModel.php';
class WorkHoursController{
  	//!! This controller often redirects to /users as this is where WorkHours are rendered to user

   /*
   	*	CREATE 
  	*/
  	public static function create() {
  		$p = WorkHoursController::params();

  		//don't allow adding hours to other users 
  		if($_SESSION['user']!=$p['usr']){ redirect("/users", array("u" => $p['usr'], "notice" => "can't add hours to other users")); }

  		//validate params -> render&exit if invalid
		WorkHoursController::validateParams($p);

        if(WorkHour::addWorkHour($p['day'], $p['hour1'], $p['hour2'], $p['hour3'], $p['usr'])){
        	redirect("/users", array("u" => $_SESSION['user'], "notice" => "created successfully"));
        }
        //redirect to users?u=username if db rejects create
		redirect("/users", array("u" => $_SESSION['user'], "notice" => "db rejected create"));
    }

   /*
   	*	UPDATE
  	*/
	public static function update() {
		$id = in('post', 'hiddenID');
		$p = WorkHoursController::params();

		//don't allow updating other users' hours. 
		if($_SESSION['user']!=$p['usr']){ redirect("/users", array("u" => $p['usr'], "notice" => "can't update hours of other users")); }

		//validate params -> render&exit if invalid
		WorkHoursController::validateParams($p);

		//update also checks that the id and username match, so changing the hidden user parameter does not allow malicious activity
        if(WorkHour::updateWorkHour($id, $p['day'], $p['hour1'], $p['hour2'], $p['hour3'], $p['usr'])){
        	redirect("/users", array("u" => $_SESSION['user'], "notice" => "update success"));	
        }
        //redirect to users?u=username if db rejects update
		redirect("/users", array("u" => $_SESSION['user'], "notice" => "db rejected update"));
        
	}

   /*
   	*	DESTROY
  	*/
	public static function destroy() {
		$id = htmlspecialchars(in('post', 'hiddenID'));
		$user = htmlspecialchars(in('post', 'user'));
		$psswd = htmlspecialchars(in('post', 'password'));

		if($_SESSION['user']!=$user){ redirect("/users", array("u" => $user, "notice" => "can't destroy hours of other users")); }

		if(User::authenticate($_SESSION['user'], $psswd)){
			//destroy also checks that the id and username match, so changing the hidden user parameter does not allow malicious activity
			if(WorkHour::destroyWorkHour($id, $user)) {
				redirect("/users", array("u" => $_SESSION['user'], "notice" => "destroy success"));
			}	
			redirect("/users", array("u" => $_SESSION['user'], "notice" => "db rejected destroy"));
		}
		redirect("/users", array("u" => $_SESSION['user'], "notice" => "wrong password"));
	}

   /*
   	*	PRIVATES
  	*/

	private static function params() {
		$d = in('post', 'day'); //regex validation
        $h1 = in('post', 'hours'); //must be numeric validation
        $h2 = in('post', 'offhours'); //must be numeric validation
        $h3 = in('post', 'standbyhours'); //must be numeric validation
        $u = htmlspecialchars(in('post', 'user')); 

        return array("day" => $d, "hour1" => $h1, "hour2" => $h2,"hour3" => $h3, "usr" => $u);
	}

	private static function validateParams($p){


		if(empty($p['day']) || !(preg_match('/^\d{4}-\d{2}-\d{2}/', $p['day']))){
			WorkHoursController::render($p, "invalid date!");
		}

		if(!is_numeric($p['hour1'])){
			WorkHoursController::render($p, "invalid hours 6-22!");
		}

		if(!is_numeric($p['hour2'])){
			WorkHoursController::render($p, "invalid hours 22-6!");
		}

		if(!is_numeric($p['hour3']) || $p['hour3']>24){
			WorkHoursController::render($p, "invalid hours standby!");
		}

		if($p['hour1']>16) {WorkHoursController::render($p, "hours 6-22 should not be more than 16");}
		if($p['hour2']>8) {WorkHoursController::render($p, "hours 6-22 should not be more than 8");}
	}

	private static function render($p, $notice){
		$workHours = WorkHour::getUsersWorkHours($p['usr']);
		$user = User::getUser($p['usr']);

		
		if(empty($notice)){unset($notice);}
	    render('Users/show.php', array("user" => $user,
	    							   "notice" => $notice,
	    							   "lista" => $workHours,
	    							   "uparams" => $p));
	}

}?>