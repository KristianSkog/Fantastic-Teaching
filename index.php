<?php
session_start();
error_reporting(0);
require_once("classes/DB.class.php");
// if GET isnt set or doesnt contain anything give $class and $method the values Page and start.
	if (!isset($_GET) || count($_GET)<=0) {
		$class = "Page";
		$method = "start";
	}else{
// if the first wasnt true, give $class and $method the values it finds in URL.
		$url_parts = getUrlParts($_GET); 

		$class = array_shift($url_parts); // takes the first value from GET and puts it in $$class
		$method = array_shift($url_parts); // takes the second value from GET and puts it in $method
	}

// if $class and is Page and $method is start or create go to that class and method and put what it returns in $data.
	if($class == 'Page' && ($method == 'start' || $method == 'create')){
		require_once("classes/".$class.".controller.php");
		$data = $class::$method($url_parts);
// if first isnt true and it excists an $_SESSION containging a userID you are allowed to visit and put what it returns in $data
	}elseif($_SESSION['userID']){
		require_once("classes/".$class.".controller.php");
		$data = $class::$method($url_parts);
	}else{
//if no $_SESSION userID excists load the templates below.
		$data = array(
			'templates'=>array('header.html','login.html','footer.html')	
		);
		
//ska istället köra en header() till /homepage
	}
	
	// if there is an redirect go there, otherwise render the page it gets from $template and $data.

	if(isset($data['redirect'])){

		header("Location: ".$data['redirect']); 
	}else{

			$twig = startTwig();
	 		$template = 'index.html';
			echo $twig->render($template, $data);
	}

//shares URL to Class/method/parameter and puts it in an array.
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

//Loads and starts twig object
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