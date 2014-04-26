<?php
require './models/UserModel.php';

class UsersController{
   /*
   	*	INDEX
  	*/
  	public static function index(){
  		
  		
  		$notice = in('get', 'notice');
  		if ( empty($notice) ) { unset( $notice ); }

	    render('Users/index.php', array(
	                "lista" => User::getUsers(),
	                "notice" => $notice,
	                "uparams" => array("username", "password", "password confirmation")
	            ));
  	}

   /*
   	*	SHOW
  	*/
	public static function show(){		
		$user = in('get', 'u');
		$month = in('get', 'm');
		if(!preg_match('/^\d{4}-\d{2}/', $month)){
			unset($month);
		}

		if($user != $_SESSION["user"] && $_SESSION["rank"]!= 1){
			render('index.php', array("notice" => "Access denied"));
		}
		UsersController::renderUser($user, in('get', 'notice'), $month);
  	}

   /*
   	*	CREATE 
  	*/
  	public static function create() {
  		if($_SESSION['rank']!=1){ render('index.php', array("notice" => "Access denied")); }

        $u = in('post', 'username');
        $p1 = in('post', 'password1');
        $p2 = in('post', 'password2');
        
        UsersController::validateParams($u, $p1, $p2);

        if(User::addUser($u, $p1)){
        	redirect("/users/", array("notice" => "created successfully"));	
        }
        UsersController::render(array($u, $p1, $p2), "something went wrong in db");        
    }

   /*
   	*	UPDATE
  	*/
	public static function update() {
		$u = in('post', 'username');
		if($_SESSION['user']!=$u){ redirect("/users", array("u" => $u, "notice" => "access denied")); }
		
		if(!User::authenticate($u, in('post', 'password'))) { UsersController::renderUser($u, "wrong password!"); }
		
		$firstname = htmlspecialchars(in('post', 'firstname'));
		$lastname = htmlspecialchars(in('post', 'lastname'));
		$phone = htmlspecialchars(in('post', 'userphone'));
		$email = htmlspecialchars(in('post', 'useremail'));
		$address = htmlspecialchars(in('post', 'useraddr'));
		$psswd = htmlspecialchars(in('post', 'password1'));
		$psswd2 = htmlspecialchars(in('post', 'password2'));

		if(empty($psswd) && empty($psswd2)){
			$password=null;			
		} elseif(strcmp($p1, $p2) == 0 && strlen($psswd)>3){
			$password=$psswd;
		} else {
			if (strlen($psswd) < 4) { $notice = "too short new password"; }
			else { $notice = "new passwords didn't match"; }			
			UsersController::renderUser($u, in('get', 'notice'));			
		}

		if(User::updateUser($u, $firstname, $lastname, $phone, $email, $address, $password)){
			redirect("/users", array("u"=>$u, "notice" => "updated successfully"));	
		}
		UsersController::renderUser($u, "error - check inputs");
	}

   /*
   	*	DESTROY
  	*/
	public static function destroy() {
		if($_SESSION['rank']!=1){ render('index.php', array("notice" => "Access denied")); }

		$usr = in('post', 'username');
		$psswd = in('post', 'password');

		if (User::authenticate($_SESSION['user'],$psswd )) {
			if (User::destroyUser($usr)) {
				redirect('/users/', array("notice" => "destroy success"));	
			}		
		}
		UsersController::render(null, "destroy failed, check password!");		

	}

   /*
   	*	APPROVE
  	*/

  	public static function approve(){
  		$user = in('post', 'u');				
		if($user != $_SESSION["user"]){
			redirect("/users", array("u"=>$user, "notice" => "can't approve other user's hours!"));	
		}
		if(WorkHour::approveUsersHours($user)){
			redirect("/users", array("u"=>$user, "notice" => "updated successfully"));	
		}
		UsersController::renderUser($user, null);
		
  	}


   /*
   	*	PRIVATE
  	*/


	private static function validateParams($u, $p1, $p2){
		$uparams = array($u, $p1, $p2);
		if(strlen($u) < 4){
			UsersController::render($uparams, "too short username");
		}

		if(strlen($u) > 10){
			UsersController::render($uparams, "too long username");
		}

		if(strcmp($p1, $p2) != 0){
			UsersController::render(array($u), "passwords don't match");		
		}

		if(strlen($p1) < 4){
			UsersController::render(array($u), "too short password");	
		}
	}

	private static function renderUser($username, $notice, $month) {
		$workHours = WorkHour::getUsersWorkHours($username, $month);
		$user = User::getUser($username);

		
		if(empty($notice)){unset($notice);}
	    render('Users/show.php', array("user" => $user,
	    							   "notice" => $notice,
	    							   "lista" => $workHours));

	}

	private static function render($uparams, $notice){
	    render('Users/index.php', array(
	            "lista" => User::getUsers(),
	            "notice" => $notice,
	            "uparams" => $uparams
	        ));
	}

}


?>
