<?php
class User {
	public static function authenticate($username, $password){
		global $db;

		$sql = "SELECT username, password FROM user WHERE username=?";
        $params = array($username);

        $result = $db->query($sql, $params);
    	
		$str1 = md5($password);        
		$str2 = $result[0]['password'];

    	if($str1 == $str2){    
    		return true;
    	} else {    	

    		return false;
    	}
	}

    public static function getRank($username){
        global $db;

        $sql = "SELECT rank FROM user WHERE username=?";
        $params = array($username);

        $result = $db->query($sql, $params);
        return $result[0]['rank'];
    }

    public static function getUser($username){
        global $db;

        $sql = "SELECT * FROM user WHERE username=?";
        $params = array($username);

        $result = $db->query($sql, $params);
        return $result[0];
    }

    public static function getUsers() {
        global $db;
        $sql = "SELECT * FROM user";        
        return $db->query($sql, null); //no params
    }

    public static function getUserNames(){
        global $db;
        $sql = "SELECT username FROM user";
        return $db->query($sql, null); //no params
    }    

    public static function addUser($u, $p){
        global $db;
        $sql = "INSERT INTO user SET username=?, password=?";
        $params = array($u, md5($p));
        
        return $db->insertQuery($sql, $params);
    }

    public static function destroyUser($username){
        global $db;
        $q = "DELETE FROM user WHERE username=?";
        $params = array($username);
        
        return $db->insertQuery($q, $params);
    }

    public static function updateUser($username, $firstname, $lastname, $phone, $email, $address, $password){
        global $db;
        if(isset($password)){
            $q = "UPDATE user SET firstname=?,lastname=?,phone=?,email=?,address=?,password=? WHERE username=?";
            $params = array($firstname, $lastname, $phone, $email, $address, md5($password), $username);
        } else {
            $q = "UPDATE user SET firstname=?,lastname=?,phone=?,email=?,address=? WHERE username=?";
            $params = array($firstname, $lastname, $phone, $email, $address, $username);
        }        
        return $db->insertQuery($q, $params);
    }
}
?>