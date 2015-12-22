<?php
class User{
	private $id;
	private $username;

	function __construct($cleanUsername, $cleanPassword){
		
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		

		// fråga till sql-db med tvättade variabler
		$query = "
		SELECT users.id, users.username
		FROM users 
		WHERE username='".$cleanUsername."' 
		AND password='".$cleanPassword."'
		";


		//Om resultat finns ur databasen, lagra ID o username i session
		if($result = $mysqli->query($query)){
			while( $row = $result->fetch_assoc() ){
				$this->id = $row['id'];
				$this->username = $row['username'];
			}
		}else{
			echo $mysqli->error;
		}
		
		$_SESSION['userID'] = $this->id;
	}

	function getUserID(){
		return $this->id;
	}

	function getUsername(){
		return $this->username;
	}
}
?>