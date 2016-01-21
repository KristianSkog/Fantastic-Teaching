<?php
/*
class Account{
	private $id;
	private $username;

	static function logInControl($cleanUsername, $cleanPassword) {
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
				$this->id = $row['id'];
				$this->username = $row['username'];
				$_SESSION['userID'] = $this->id;
			}
		}else{
			echo $mysqli->error;
		}
	}

	function getUserID(){
		return $this->id;
	}

	function getUsername(){
		return $this->username;
	}
}*/
?>