<?php
class Account{
	static private $id;
	static private $username;

	static function logIn($cleanUsername, $cleanPassword) {
		// fråga till sql-db med tvättade variabler
		$query = "
		SELECT users.id, users.username
		FROM users 
		WHERE username='".$cleanUsername."' 
		AND password='".$cleanPassword."'
		";
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		$result = $mysqli->query($query);
		if($result = $mysqli->query($query)){
			while( $row = $result->fetch_assoc() ){
				self::$id = $row['id'];
				self::$username = $row['username'];
				$_SESSION['userID'] = self::$id;
				$_SESSION['username'] = self::$username;
			}
		}else{
			echo $mysqli->error;
		}
	}

	static function getUserID(){
		return self::$id;
	}

	static function getUsername(){
		return self::$username;
	}
}
?>