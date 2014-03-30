<?php
session_start();
require 'lib/DB.php';
require 'lib/webutils.php';
//require 'lib/User.php';

$db = new DB();
$ru = $_SERVER['REQUEST_URI'];


// LOGIN
if($ru=="/login" && isset($_POST["username"]) && isset($_POST["password"])){
	//if($_POST["username"] == "kalle" && $_POST["password"] == "allek"){
		
	require 'models/UserModel.php';
	if(User::authenticate($_POST["username"], $_POST["password"])){
		$_SESSION["user"] = "kalle";
		render('index.php', array());
	} else{
		render('index.php', array("notice" => "Log in!"));
	}
	
}

if($ru=="/logout/"){
	unset($_SESSION['user']);
	render('index.php', array("notice" => "Log in!"));
}

if(!isset($_SESSION['user'])){
	render('index.php', array("notice" => "Log in!"));
} 


// ROUTING
require 'controllers/hours.php';
require 'controllers/users.php';
require 'controllers/report.php';

//echo "ru laitettu: ".isset($ru). " ";
//echo $ru;

if($ru == '/') { render('index.php', array());}
elseif(preg_match('/^\/hours\/add/',$ru)) { CustomerHours::add_hours(); }
elseif(preg_match('/^\/hours/',$ru)) { CustomerHours::render(); }
elseif(preg_match('/^\/users\/1/',$ru)) { Users::show(); }
elseif(preg_match('/^\/users/',$ru)) { Users::index();  }
elseif(preg_match('/^\/report/',$ru)) { Report::render();  }
elseif(preg_match('/^\/test/',$ru)) { require 'connectionTest.php';  }
else{ echo "404";}
//else { show_404(); }
?>