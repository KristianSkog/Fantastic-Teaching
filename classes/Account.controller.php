<?php

class Account {

	// public static function login() {
	// 	require_once("classes/Account.model.php");
	// 	require_once("classes/Cleaner.class.php");
	// 	$login = AccountModel::logIn($_POST['username'], $_POST['password']);
	// 	if($login){
	// 	header('Location: /Fantastic-Teaching/?/User/home');
	// }
	
	// }

	// public static function create() {
	// 	require_once("classes/Account.model.php");
	// 	require_once("classes/Cleaner.class.php");
	// 	$create = AccountModel::createAccount($_POST['newUsername'], $_POST['newPassword'], $_POST['allowedEmail']);
	// 	return header('Location: /Fantastic-Teaching/?/User/home');
	// }

	public static function change() {
		require_once("classes/Account.model.php");
		require_once("classes/Cleaner.class.php");
		$create = AccountModel::changePassword($_POST['userForUpdate'], $_POST['updatedPassword']);
		return header('Location: /Fantastic-Teaching/?/User/home');
	}

	public static function logout() {
		if (isset($_POST['logout'])) session_unset();
		return header('Location: /Fantastic-Teaching/');
	}
}