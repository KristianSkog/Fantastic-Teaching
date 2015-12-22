<?php
session_start();

//om logga ut finns i get - unsetta innan något printas på sajten
if (isset($_GET['logout'])) {
	unset($_SESSION['userID']);
	unset($_SESSION['username']);
}


//dynamiskt innehåll twig kan visa
$data= [
	'title' => "Titel på sidan"
/*om man vill lägga in det returnerade värdet ur ett objekts metod skriver man såhär:
	'twigvar' => $object->method()
	*/
	]; //lista med twig-värden avsluts-tagg


// hämtar instans av uppkoppling till databasen ur klassen DB
$mysqli = DB::getInstance();

//Tvättar username och password innan vi skickar fråga till databas
$cleanUsername = $mysqli->real_escape_string($_POST['username']);
$cleanPassword = $mysqli->real_escape_string($_POST['password']);


// fråga till sql-db med tvättade variabler
$query = "
SELECT users.id, users.username
FROM users 
WHERE username='".$cleanUsername."' 
AND password='".$cleanPassword."'
";


//Om resultat finns ur databasen, lagra ID o username i session
if($result = $mysqli->query($query)){
	while( $row = $result->fetch_assoc() ){
		$_SESSION['userID'] = $row['id'];
		$_SESSION['username'] = $row['username'];
	}
}else{
	echo $mysqli->error;
}


//Om inloggad - skriv ut välkommen och logga ut-knapp
if (isset($_SESSION['userID'])) {
echo "Välkommen <b>".$_SESSION['username']."</b>";
echo '
	<form method="get" action="">
	<button type="submit" name="logout" value="'.$_SESSION['userID'].'">Logout '.$_SESSION['username'].'</button>
	</form>';
}


//Läser in Twig
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


//Läser in klasser
function __autoload($x) {
	include 'classes/'.$x.'.class.php';
}