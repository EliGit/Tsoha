<?php
class User {
	public static function authenticate($username, $password){
		global $db;

		$sql = "SELECT username, password FROM user WHERE username='$username'";
    	$query = $db->getConn()->prepare($sql);
    	$query->execute();

    	$result = $query->fetchAll(PDO::FETCH_ASSOC);


		//echo $password;
		//echo $result[0]['username'];
		$str1 = $password;
		$str2 = $result[0]['username'];
		//echo strcmp($str2, $str1);

    	if(strcmp($str2, $str1)==0){
    	//	echo "true";    		
    		return true;
    	} else {
    	//	echo "false";
    		return false;
    	}
    	//echo $result[0]['username'];

	}
}
?>