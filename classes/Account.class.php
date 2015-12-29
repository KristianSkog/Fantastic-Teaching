<?php
class Account{
	static private $id;
	static private $username;

	static function createAccount($dirtyNewUsername, $dirtyNewPassword, $dirtyNewEmail) {
		
		$cleanNewUsername = Cleaner::cleanVar($dirtyNewUsername);
		$cleanNewPassword = Cleaner::cleanVar($dirtyNewPassword);
		$safeNewPassword = hash("sha512", $cleanNewPassword);

		//verify e-mail to match with allowed acoounts
		$cleanNewEmail = Cleaner::cleanVar($dirtyNewEmail);
		$safeNewEmail = hash("sha512", $cleanNewEmail);
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		$queryEmailCheck = "
		SELECT allowed_accounts.email
		FROM allowed_accounts 
		WHERE email='".$safeNewEmail."'
		LIMIT 1
		";

		$resultEmailCheck = $mysqli->query($queryEmailCheck);
		$rowEmailCheck = $resultEmailCheck->fetch_assoc();

		//Kontroll - unikt användarnamn
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		$queryUsernameCheck = "
		SELECT username
		FROM users
		WHERE username='".$cleanNewUsername."'
		LIMIT 1
		";

		$resultUsernameCheck = $mysqli->query($queryUsernameCheck);
		$rowUsernameCheck = $resultUsernameCheck->fetch_assoc();

		if ($rowEmailCheck == !NULL AND $rowUsernameCheck == NULL) {
			// fråga till sql-db med tvättade säkra variabler
			$queryAddUser = "
			INSERT INTO users (username, password) 
			VALUES ('$cleanNewUsername','$safeNewPassword')";

			//instans av db-uppkoppling
			$mysqli = DB::getInstance();
			$mysqli->query($queryAddUser);
		}else{
			echo "Unfortunately your E-mail are not yet approved for signing up in order to use our service.<br>
			OOOOR:<br>
			your chosen username is already used by someone else. Some lucky bastard..";
		}
	}

	static function logIn($dirtyUsername, $dirtyPassword) {
		$cleanUsername = Cleaner::cleanVar($dirtyUsername);
		$cleanPassword = Cleaner::cleanVar($dirtyPassword);
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