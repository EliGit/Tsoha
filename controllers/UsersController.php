<?php
require './models/UserModel.php';
class Users{
  

  public static function index(){
    render('users/index.php', array(
      'lista' => User::getUsers()
    ));
  }

  public static function show(){
    render('users/show.php', array());
  }

}


?>