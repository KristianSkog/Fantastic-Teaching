<?php
// functionality to login or create an account which is called on if you have no userID from session
class Page {


	public static function start() {
		require_once("classes/Account.model.php");
		require_once("classes/Cleaner.class.php");
		$login = AccountModel::logIn($_POST['username'], $_POST['password']);
		if($login){
		header('Location: /Fantastic-Teaching/?/User/home');
	}
	return
		$data = array(
			'templates'=>array('header.html','login.html','footer.html')
		);
	}
	public static function create() {
		require_once("classes/Account.model.php");
		require_once("classes/Cleaner.class.php");
		$create = AccountModel::createAccount($_POST['newUsername'], $_POST['newPassword'], $_POST['allowedEmail']);
		return header('Location: /Fantastic-Teaching/?/User/home');
	}
}