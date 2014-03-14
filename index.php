<?php
require 'lib/User.php';
require 'lib/DB.php';


$db = new DB();

function getUsers() {
  global $db;
  $sql = "SELECT id, name, password FROM users";
  $query = $db->getConn()->prepare($sql); 
  $query->execute();
    
  $tulokset = array();
  foreach($query->fetchAll(PDO::FETCH_OBJ) as $result) {
    $user = new User();
    $user->setId($result->id);
    $user->setName($result->name);
    $user->setPassword($result->password);

    $tulokset[] = $user;
  }
  return $tulokset;
}


render('userlist.php', array(
	'lista' => getUsers()
	));

function render($sivu, $data=array()) {
	$data = (object)$data;
    require 'views/layout.php';
    exit();
  }
?>