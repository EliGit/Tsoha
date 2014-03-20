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
?>