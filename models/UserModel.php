<?php
class User {
	public static function authenticate($username, $password){
		global $db;

		$sql = "SELECT username, password FROM user WHERE username='$username'";
        $result = $db->query($sql);
    	
    	//print_r($username);
        //print_r($password);
        //print_r($result);
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
        $query = $db->getConn()->prepare($sql);
        $query->execute();
          
        $tulokset = array();
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
          $tulokset[] = $result;
        }

        return $tulokset;
    }

    public static function getUserNames(){
        global $db;
        $sql = "SELECT username FROM user";
        $query = $db->getConn()->prepare($sql);
        $query->execute();
          
        $tulokset = array();
        foreach($query->fetchAll(PDO::FETCH_ASSOC) as $result) {
          $tulokset[] = $result;
        }

        return $tulokset;
    }    
}
?>