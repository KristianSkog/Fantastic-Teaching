<?php
session_start();

//om logga ut finns i get - unsetta innan något printas på sajten
if (isset($_GET['logout'])){
	unset($_SESSION['userID']);
}

//instans av db-uppkoppling
$mysqli = DB::getInstance();

if (isset($_POST['username'])) {
//Tvättar username och password innan vi skickar fråga till databas
	if (isset($_POST['username']))$cleanUsername = Cleaner::cleanVar($_POST['username']);
	if (isset($_POST['password']))$cleanPassword = Cleaner::cleanVar($_POST['password']);
	account::logIn($cleanUsername, $cleanPassword);
}

//Om vi inte har inloggad användare - visa detta:
if (!isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Titel på sidan",
	]; //data-array till twig avslutas
}



//$content är alltid deklarerad nu annars fick man problem med visning.
$content = new Content();
if(isset($_POST['postContent'])) $content->addContent($_POST['title'], $_POST['text']);
if(isset($_POST['search']))$cleanSearch = Cleaner::cleanVar($_POST['search']);
if(isset($_POST['search'])){
	$content = $content->searchContent($cleanSearch);
	$showBtn = "<form method='get' action=''><button type='submit' name='showAll'>Show all content</button></form>";
}elseif (isset($_POST['showAll'])){
	$content = $content->viewContent();
	$showBtn = NULL;
}else{
	$content = $content->viewContent();
	$showBtn = NULL;
}


//Om vi har inloggad användare - visa detta:
if (isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Titel på sidan",
	'content' => $content,
	'user' => $_SESSION['username'],
	'sessionUserID' => $_SESSION['userID'],
	'showBtn' => $showBtn
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
elseif (!isset($_SESSION['userID'])) {
	echo $twig->render('login.html', $data);
}

//Läser in klass-filer
function __autoload($x) {
	include 'classes/'.$x.'.class.php';
}