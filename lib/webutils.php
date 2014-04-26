<?php
function render($sivu, $data=array()) {
	$data = (object)$data;
    require 'views/layout.php';
    exit();
  }
  
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