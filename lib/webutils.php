<?php
/*
	WEBUTILS - HELPER FUNCTIONS FOR THE APP.
*/

/*
	Render helper. Usage: render('/view.php', array('param' => 'value'));
	View can access data from $data.
*/
function render($sivu, $data=array()) {
	$data = (object)$data;
    require 'views/layout.php';
    exit();
  }
  
/*
	GET/POST params helper. Usage: in('method', 'param');
*/
function in($method,$key) {
	if(!preg_match('/^(get|post)$/',$method)) {
		return false;
	}
	if(!$key) {
		return false;
	}
	
	if($method == 'get') {
		if(isset($_GET[$key])) {
			return $_GET[$key];
		}
		return false;
	}

	if($method == 'post') {
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
		return false;
	}
	return false;
}

/*
	Redirect helper. Usage: redirect('/url', array('param' => 'value'));
*/

function redirect($url, $getParams='' ,$statusCode = 303)
{
	if(empty($getParams)){ 		
		header('Location: ' . $url , true, $statusCode); }
	else {		
		header('Location: ' . $url . '?' . http_build_query($getParams), true, $statusCode);
	}
   	die();
}
?>