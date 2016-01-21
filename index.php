<?php
session_start();
require_once("classes/DB.class.php");
if (count($_GET)>0) {
	$url_parts = getUrlParts($_GET); 

	$class = array_shift($url_parts); # tar ut första värdet och lägger den i $class, i vårt exempel ovan "Posts"
	$method = array_shift($url_parts); # tar ut andra värdet och lägger den i $method, i vårt exempel ovan "single"

	# Hämta in filen för den klass vi ska anropa
	require_once("classes/".$class.".controller.php"); 

	$data = $class::$method($url_parts);
	//data är resultatet av class/method/parametern som startades via URLen

	if(isset($data['redirect'])){
	// om $data fick en 'redirect' från metoden vi kört
		header("Location: ".$data['redirect']); 
	}else{
	// om $data INTE har 'redirect'
			$twig = startTwig();
	 		$template = 'index.html';
			echo $twig->render($template, $data);
	}
}else{
		require_once("classes/Account.controller.php"); 
		$data = Account::login();
		$template = 'index.html';
		$twig = startTwig();
		echo $twig->render($template, $data);
}

//Delar URL till class/method/parameter i array
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

//Laddar o startar Twig-objekt
function startTwig(){
	require_once('Twig/lib/Twig/Autoloader.php');
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem('templates/');
	return $twig = new Twig_Environment($loader);
}

//Läser in klass-filer
function __autoload($x) {
	include 'classes/'.$x.'.class.php';
}