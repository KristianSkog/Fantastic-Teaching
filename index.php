<?php
session_start();

$data= [
	'title' => "Titel på sidan"
/*'twigvar' => $object->method(),*/
	];


$query = "SELECT id FROM users WHERE users.username = $_GET['username'] AND users.password = $_GET['password']";

//Läser in Twig
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);
if (1+1== false) {
echo $twig->render('index.html', $data);
}
else{
	echo $twig->render('login.html', $data);
}

//Läser in klasser
function __autoload($x) {
	include 'classes/'.$x.'.class.php';
}