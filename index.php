<?php
require 'lib/DB.php';
require 'lib/webutils.php';
require 'lib/User.php';

$db = new DB();
$ru = $_SERVER['REQUEST_URI'];


function add_hours() {
	global $db;

	$day = in('post','day');
	
	$customer = in('post','customer');

//	if($customer == 'new') {
//		$customer = in('post','new_customer');
//	}
	$people = in('post','people');
	$description = in('post','description');
	$hours = in('post','hours');
	$offhours = in('post','offhours');
	
	if(!$hours) { $hours = '0'; }
	if(!$offhours) { $offhours = '0'; }
	$q = "INSERT INTO hour SET day='".$db->quote($day)."',customer='".$db->quote($customer)."',people='".$db->quote($people)."',description='".$db->quote($description)."',hours=".$db->quote($hours).",offhours=".$db->quote($offhours).",deleted=0";

	
	$db->insertQuery($q);

	
	header('Location: /hours/');
}



// ROUTING
require 'controllers/hours.php';
require 'controllers/users.php';
require 'controllers/report.php';


if($ru == '/') { render('index.php', array());}
elseif(preg_match('/^\/hours\/add/',$ru)) { add_hours(); }
elseif(preg_match('/^\/hours/',$ru)) { CustomerHours::render(); }
elseif(preg_match('/^\/users\/1/',$ru)) { Users::show(); }
elseif(preg_match('/^\/users/',$ru)) { Users::index();  }
elseif(preg_match('/^\/report/',$ru)) { Report::render();  }
elseif(preg_match('/^\/test/',$ru)) { require 'connectionTest.php';  }
else{ echo "404"; }
//else { show_404(); }





?>