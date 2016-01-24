<?php
class AccountModel{
	//takes username password and email from form. Cleans it using the cleaner class. 
	static function createAccount($dirtyNewUsername, $dirtyNewPassword, $dirtyNewEmail) {

		//cleans our parameters:
		$cleanNewUsername = Cleaner::cleanVar($dirtyNewUsername);
		$cleanNewPassword = Cleaner::cleanVar($dirtyNewPassword);
		$cleanNewEmail = Cleaner::cleanVar($dirtyNewEmail);
		
		//creates long, random salt:
		$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
		$salt = mcrypt_create_iv($size);

		//hashes our cleaned password with added salt and creates a uniqe combination with them two. 
		$safeNewPassword = hash("sha512", "$salt"."$cleanNewPassword");
		
		//verify e-mail to match with allowed acoounts
		$safeNewEmail = hash("sha512", $cleanNewEmail);
		$mysqli = DB::getInstance();
		$queryEmailCheck = "
		SELECT allowed_accounts.email
		FROM allowed_accounts 
		WHERE email='".$safeNewEmail."'
		";
		$resultEmailCheck = $mysqli->query($queryEmailCheck);
		$rowEmailCheck = $resultEmailCheck->fetch_assoc();

		//checks if username exists in database
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
		$queryUsernameCheck = "
		SELECT username
		FROM users
		WHERE username='".$cleanNewUsername."'
		";
		$resultUsernameCheck = $mysqli->query($queryUsernameCheck);
		$rowUsernameCheck = $resultUsernameCheck->fetch_assoc();

		if ($rowEmailCheck == !NULL AND $rowUsernameCheck == NULL) {
			// fråga till sql-db med tvättade säkra variabler
			$queryAddUser = "INSERT INTO users (username, salt, password) 
			VALUES ('".$cleanNewUsername."', '".$salt."', '".$safeNewPassword."')";
			//instans av db-uppkoppling
			$mysqli = DB::getInstance();
			$mysqli->query($queryAddUser);
		}else{
			echo "Unfortunately your E-mail are not yet approved for signing up in order to use our service.<br>
			OOOOR:<br>
			your chosen username is already used by someone else. Some lucky bastard.. Try another one :)";
		}
	}
	static function logIn($dirtyUsername, $dirtyPassword) {
		//recives username and Password from form. then checks it with database. puts id, username and userLevel in a SESSION. if it returns TRUE the user can see website.


		$mysqli = DB::getInstance();

		//clean parameters
		$cleanUsername = Cleaner::cleanVar($dirtyUsername);
		$cleanPassword = Cleaner::cleanVar($dirtyPassword);

		//Retrieve salt from named user
		$queryGetSalt = "
		SELECT salt
		FROM users
		WHERE users.username = '".$cleanUsername."'
		LIMIT 1
		";
		$resultSalt = $mysqli->query($queryGetSalt);
		if($resultSalt = $mysqli->query($queryGetSalt)){
			$rowSalt = $resultSalt->fetch_assoc();
			$userSalt = $rowSalt['salt'];
		}

		//hashes our cleaned password input with retrieved salt to match with database:
		$safePassword = hash("sha512", "$userSalt"."$cleanPassword");
		
		// query to database and checks if user and password is the same.
		$queryGetUserMatch = "
		SELECT users.id, users.username, users.level
		FROM users 
		WHERE username='".$cleanUsername."' 
		AND password='".$safePassword."'
		";

		$result = $mysqli->query($queryGetUserMatch);
		if($result = $mysqli->query($queryGetUserMatch)){
			while( $row = $result->fetch_assoc() ){
				$_SESSION['userID'] = $row['id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['userLevel'] = $row['level'];
			}
		}else{
			echo $mysqli->error;
		}
		if($_SESSION['userID']){
			return TRUE;
		}else
			return FALSE;
	}

	static function changePassword($userToChange, $dirtyUpdatedPassword){
		//Recieves new password. hashes with Salt. Updates database with new password. 

		$mysqli = DB::getInstance();
		$cleanUpdatedPassword = Cleaner::cleanVar($dirtyUpdatedPassword);
		
		//creates long, random salt:
		$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
		$newSalt = mcrypt_create_iv($size);

		//hashes our cleaned password with added salt:
		$safeUpdatedPassword = hash("sha512", "$newSalt"."$cleanUpdatedPassword");
		$queryChangePassword = "
		UPDATE users
		SET password='".$safeUpdatedPassword."', salt='".$newSalt."'
		WHERE users.id=".$userToChange.";
		";
		$mysqli->query($queryChangePassword);
	}
}