<?php
class User {
  
  private $id;
  private $name;
  private $password;

  //public function __construct($id, $name, $password) {
  #  $this->id = $id;
  #  $this->name = $name;
  #  $this->password = $password;
  //}

  public function __construct() {
    
  }

  public function setID($id){
  	$this->id = $id;
  }

  public function setName($name){
  	$this->name = $name;
  }

  public function setPassword($password){
  	$this->password = $password;
  }

  public function __toString()
    {
        return "id: $this->id, name: $this->name, passwd: $this->password";
    }
  
}