<?php
class LoginController{
	public static function login(){
		require 'models/UserModel.php';
		if(User::authenticate($_POST["username"], $_POST["password"])){
			$_SESSION["user"] = $_POST["username"];
			$_SESSION["rank"] = User::getRank($_POST["username"]);
			redirect('/', array("login" => "success"));
		} 
		redirect('/', array("login" => "failed"));
	}

	public static function logout(){
		unset($_SESSION['user']);
		redirect('/');
	}

	public static function isLogged(){		
		return isset($_SESSION['user']);
	}

	public static function render(){
		$arr = array();
		
		//if login status set (failed or success), pass to view index.php to show to user
		if(isset($_GET['login'])) $arr['login'] = $_GET['login'];

		if(self::isLogged()) {			
			render('index.php', $arr);
		}else {			
			//nog logged in -> tell user to log in
			$arr["notice"] = "Log in !";
			render('index.php', $arr);
		}
	}
}
?>