<?php
function render($sivu, $data=array()) {
	$data = (object)$data;
    require 'views/layout.php';
    exit();
  }

?>