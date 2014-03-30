<?php
class LoginController{
	public static function login(){
		require 'models/UserModel.php';
		if(User::authenticate($_POST["username"], $_POST["password"])){
			$_SESSION["user"] = "kalle";
			redirect('/', array("login", "success"));
		} 
		redirect('/', array("login", "failed"));
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
		if(isset($_GET['login'])) $arr['login'] = $_GET['login'];

		if(self::isLogged()) {			
			render('index.php', $arr);
		}else {			
			$arr["notice"] = "Log in !";
			render('index.php', $arr);
		}
	}
}
?>