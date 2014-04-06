<?php
require './models/UserModel.php';
class UsersController{
  
  	public static function index(){
	    render('Users/index.php', array(
	                "lista" => User::getUsers(),
	                "notice" => $_GET['notice'],
	                "uparams" => array("username", "password", "password confirmation")
	            ));
  	}

	public static function show(){
	    render('Users/show.php', array());
  	}

  	public static function create() {
        $u = in('post', 'username');
        $p1 = in('post', 'password1');
        $p2 = in('post', 'password2');
        
        UsersController::validateParams($u, $p1, $p2);

        if(User::addUser($u, $p1)){
        	redirect("/users/", array("notice", "created successfully"));	
        }
        UsersController::render(array($u, $p1, $p2), "something went wrong in db");
        

    }

	public static function update() {

	}

	public static function destroy() {

	}

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

	private static function render($uparams, $notice){
	    render('Users/index.php', array(
	            "lista" => User::getUsers(),
	            "notice" => $notice,
	            "uparams" => $uparams
	        ));
	}

}


?>
