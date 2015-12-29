<?php
class Account{
	static private $id;
	static private $username;

	static function createAccount($cleanNewUsername, $cleanNewPassword) {
		$safeNewPassword = hash("sha512", $cleanNewPassword);

		// fråga till sql-db med tvättade säkra variabler
		$query = "
		INSERT INTO users (username, password) 
		VALUES ('$cleanNewUsername','$safeNewPassword')";

		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		$mysqli->query($query);
	}

	static function logIn($cleanUsername, $cleanPassword) {
		$safePassword = hash("sha512", $cleanPassword);
		
		// fråga till sql-db med tvättade variabler
		$query = "
		SELECT users.id, users.username
		FROM users 
		WHERE username='".$cleanUsername."' 
		AND password='".$safePassword."'
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