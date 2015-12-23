<?php
session_start();

//om logga ut finns i get - unsetta innan något printas på sajten
if (isset($_GET['logout'])) unset($_SESSION['userID']);

//instans av db-uppkoppling
$mysqli = DB::getInstance();

//Tvättar username och password innan vi skickar fråga till databas
if (isset($_POST['username'])) $cleanUsername = Cleaner::cleanVar($_POST['username']);
if (isset($_POST['password'])) $cleanPassword = Cleaner::cleanVar($_POST['password']);
if (isset($cleanUsername)) $user = new User($cleanUsername, $cleanPassword);

//Om vi har inloggad användare - visa detta:
if (!isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Titel på sidan",
	]; //data-array till twig avslutas
}

//Om vi har inloggad användare - visa detta:
if (isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Titel på sidan",
	'user' => $user->getUsername(),
	'sessionName' => $_SESSION['userID']
	]; //data-array till twig avslutas
}

//Läser in Twig och renderar templates
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);
if (isset($_SESSION['userID'])) {
	echo $twig->render('index.html', $data);
}
else {
	echo $twig->render('login.html', $data);
}

//Läser in klass-filer
function __autoload($x) {
	include 'classes/'.$x.'.class.php';
}