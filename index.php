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

//if NOT logged in -> always run this, no matter what HTTP request what was used as .htaccess routes everything to /index.php
if( !LoginController::isLogged() ){LoginController::render();}


// ROUTING
require 'controllers/CustomerHoursController.php';
require 'controllers/UsersController.php';
require 'controllers/WorkHoursController.php';
require 'controllers/ReportController.php';

//hours
if(preg_match('/^\/hours\/add/',$ru)) { CustomerHoursController::create(); }
elseif(preg_match('/^\/hours\/destroy/',$ru)) { CustomerHoursController::destroy(); }
elseif(preg_match('/^\/hours\/update/',$ru)) { CustomerHoursController::update(); }
elseif(preg_match('/^\/hours/',$ru)) { CustomerHoursController::index(); }

//users
elseif(preg_match('/^\/users\/create/',$ru)) { UsersController::create(); }
elseif(preg_match('/^\/users\/destroy/',$ru)) { UsersController::destroy(); }
elseif(preg_match('/^\/users\/update/',$ru)) { UsersController::update(); }
elseif(preg_match('/^\/users\/approve/',$ru)) { UsersController::approve(); }
elseif(preg_match('/^\/users\?u=.+/',$ru)) { UsersController::show(); }
elseif(preg_match('/^\/users/',$ru)) { UsersController::index();  }
//elseif(preg_match('/^\/users\/u\/.*/',$ru)) { UsersController::show();}

//workhours
elseif(preg_match('/^\/workhours\/create/',$ru)) { WorkHoursController::create();}
elseif(preg_match('/^\/workhours\/destroy/',$ru)) { WorkHoursController::destroy();}
elseif(preg_match('/^\/workhours\/update/',$ru)) { WorkHoursController::update();}

//report
elseif(preg_match('/^\/report/',$ru)) { Report::index();  }

//connection test
elseif(preg_match('/^\/test/',$ru)) { require 'connectionTest.php';  }

//root
elseif(preg_match('/^\//', $ru)) { LoginController::render(); }
else{ header('HTTP/1.0 404 Not Found'); }
?>