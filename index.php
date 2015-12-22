<?php
session_start();

//om logga ut finns i get - unsetta innan något printas på sajten
if (isset($_GET['logout'])) {
	unset($_SESSION['userID']);
}

//dynamiskt innehåll twig kan visa
$data= [
	'title' => "Titel på sidan"
/*om man vill lägga in det returnerade värdet ur ett objekts metod skriver man såhär:
	'twigvar' => $object->method()
	*/
	]; //lista med twig-värden avsluts-tagg

//instans av db-uppkoppling
$mysqli = DB::getInstance();

//Tvättar username och password innan vi skickar fråga till databas
$cleanUsername = Cleaner::cleanVar($_POST['username']);
$cleanPassword = Cleaner::cleanVar($_POST['password']);
$user = new User($cleanUsername, $cleanPassword);

//Om inloggad - skriv ut välkommen och logga ut-knapp
if (isset($_SESSION['userID'])) {
echo "Välkommen <b>".$user->getUsername()."</b>";
echo '
	<form method="get" action="">
	<button type="submit" name="logout" value="'.$_SESSION['userID'].'">Logout '.$user->getUsername().'</button>
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