<?php


function get_all() {
	global $db;
	$sql = "SELECT * FROM hour";
	$query = $db->getConn()->prepare($sql);
	$query->execute();

	$tulokset = array();
	foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
		$tulokset[] = $result;
	}

		 
	return $tulokset;
}



render('hours.php', array(
	'lista' => get_all()
	));
?>

