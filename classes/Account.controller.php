<?php

class Account {
	// Function to change password and logout.

	public static function change() {
		//this method calls on changsPassword in account.model and updates the database with the new password.
		require_once("classes/Account.model.php");
		require_once("classes/Cleaner.class.php");
		AccountModel::changePassword($_POST['userForUpdate'], $_POST['updatedPassword']);
		return header('Location: /Fantastic-Teaching/?/User/home');
	}

	public static function logout() {
		//this method unsets the session 
		if (isset($_POST['logout'])) session_unset();
		return header('Location: /Fantastic-Teaching/');
	}
}