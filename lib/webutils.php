<?php
function render($sivu, $data=array()) {
	$data = (object)$data;
    require 'views/layout.php';
    exit();
  }
  
function in($method,$key) {
	if(!preg_match('/^(get|post)$/',$method)) {
		return FALSE;
	}
	if(!$key) {
		return FALSE;
	}
	
	if($method == 'get') {
		if(isset($_GET[$key])) {
			return $_GET[$key];
		}
		return FALSE;
	}

	if($method == 'post') {
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
		return FALSE;
	}

	return FALSE;
}

function redirect($url, $getParams='' ,$statusCode = 303)
{
	if(empty($getParams)){ 		
		header('Location: ' . $url , true, $statusCode); }
	else {
		$data = array($getParams[0]=>$getParams[1]);
		$params = http_build_query($data);
		header('Location: ' . $url . '?' . $params, true, $statusCode);
	}
   
   	die();
}
?>