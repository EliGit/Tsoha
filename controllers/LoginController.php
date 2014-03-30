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
		if(self::isLogged()) {
			if(isset($_GET['login'])){
				render('index.php', array("login" => $_GET['login']));
			}
			render('index.php', array());


		}
		else {			
			if(isset($_GET['login'])){
				render('index.php', array("login" => $_GET['login'], "notice" => "Log in !"));
			}
			render('index.php', array("notice" => "Log in !"));
		}
	}
}
?>