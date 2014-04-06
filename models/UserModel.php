<?php
class User {
	public static function authenticate($username, $password){
		global $db;

		$sql = "SELECT username, password FROM user WHERE username='$username'";
        $result = $db->query($sql);
    	
		$str1 = $password;
		$str2 = $result[0]['username'];
		
    	if(strcmp($str2, $str1)==0){    	
    		return true;
    	} else {    	
    		return false;
    	}
	}


    public static function getUsers() {
        global $db;
        $sql = "SELECT * FROM user";        
        return $db->query($sql);
    }

    public static function getUserNames(){
        global $db;
        $sql = "SELECT username FROM user";
        return $db->query($sql);
    }    

    public static function addUser($u, $p){
        global $db;
        $sql = "INSERT INTO user SET username=".$db->quote($u).", password=".$db->quote($p);
        return $db->insertQuery($sql);
    }

}
?>