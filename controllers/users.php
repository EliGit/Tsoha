<?php
class Users{
  public static function getUsers() {
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