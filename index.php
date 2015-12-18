<?php
session_start();

require_once("classes/DB.class.php");



/*Laddar in Twig: */
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);

/*Array med data som skickas till Twig:*/
$data = [
	'variabelttwignamn' => $objektnamn -> funktionsnamn(),
	'vartwig' => $variabel,
	];
/*Renderar all datautskrift med Twig via index.html*/
echo $twig -> render('index.html', $data);
/* autoload funktion för att inkludera våra classer från separata dokument*/
function __autoload($className) {
	include $className.'.class.php';
}
?>

