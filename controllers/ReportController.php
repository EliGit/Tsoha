<?php

class Report {	
	public static function index(){
		$stats = WorkHour::getUsersStats();
		render('Report/index.php', array("lista" => $stats));
	}
}

?>