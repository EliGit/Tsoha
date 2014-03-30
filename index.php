<?php
session_start();
require 'lib/DB.php';
require 'lib/webutils.php';


$db = new DB();
$ru = $_SERVER['REQUEST_URI'];



//LOGIN && LOGOUT
require 'controllers/LoginController.php';
if($ru=="/login/") {LoginController::login();}
if($ru=="/logout/") {LoginController::logout();}
if( !LoginController::isLogged() ){LoginController::render();}


// ROUTING
require 'controllers/CustomerHoursController.php';
require 'controllers/UsersController.php';
require 'controllers/ReportController.php';

if(preg_match('/^\//', $ru)) { LoginController::render(); }
elseif(preg_match('/^\/hours\/add/',$ru)) { CustomerHoursController::create(); }
elseif(preg_match('/^\/hours/',$ru)) { CustomerHoursController::index(); }
elseif(preg_match('/^\/users\/1/',$ru)) { Users::show(); }
elseif(preg_match('/^\/users/',$ru)) { Users::index();  }
elseif(preg_match('/^\/report/',$ru)) { Report::render();  }
elseif(preg_match('/^\/test/',$ru)) { require 'connectionTest.php';  }
else{ echo "404";}
//else { show_404(); }
?>