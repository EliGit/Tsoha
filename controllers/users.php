<?php
//require '../models/UserModel.php';
class Users{
  
  public static function getUsers() {
    global $db;
    $sql = "SELECT * FROM user";
    $query = $db->getConn()->prepare($sql);
    $query->execute();
      
    $tulokset = array();
    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
      $tulokset[] = $result;
    }

    return $tulokset;
  }

  public static function index(){
    render('users/index.php', array(
      'lista' => self::getUsers()
    ));
  }

  public static function show(){
    render('users/show.php', array());
  }

}






?>