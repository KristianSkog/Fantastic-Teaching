<?php
session_start();

require_once("classes/DB.class.php");


# $url_params blir en array med alla "värden" som står efter ? avgränsade med /
# ex. /Posts/single/11 kommer ge en array med 3 värden som är Posts, single och 11
$url_parts = getUrlParts($_GET); 
$class = array_shift($url_parts); # tar ut första värdet och lägger den i $class 
$method = array_shift($url_parts); # tar ut andra värdet och lägger den i $method

require_once("classes/".$class.".class.php"); # Hämta in klassfilen för den klass vi ska anropa
$data = $class::$method($url_parts); # Anropa metoden vi vill köra på klassen vi har fått från vår URL samt skicka med övriga parametrar in till den metoden

if(isset($data['redirect'])){
	header("Location: ".$data['redirect']);
}else{
	$twig = twig();

	if($class == 'Admin'){
		$template = "Admin/index.html";
	}else{
		$template = 'index.html';
	}

	echo $twig->render($template, $data);
}





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

# Funktion som "slår sönder" det vi får efter ? på alla /
# och skickar tillbaka som en array
function getUrlParts($get){
	$get_params = array_keys($get);
	$url = $get_params[0];
	$url_parts = explode("/",$url);
	foreach($url_parts as $k => $v){
		if($v) $array[] = $v;
	}
	$url_parts = $array;
	return $url_parts; 
}
/*Laddar in Twig: */
function twig(){
require_once 'Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader);
}

?>
