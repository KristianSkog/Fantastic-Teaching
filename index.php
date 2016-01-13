<?php
session_start();

//om logga ut finns i get - unsetta innan något printas på sajten
if (isset($_GET['logout'])){
	unset($_SESSION['userID']);
	header('Location: http://192.168.33.10/Fantastic-Teaching/');
}



if (isset($_POST['deleteContentID'])) {
	Content::deleteContent($_POST['deleteContentID']);
}

if (isset($_POST['deleteGoalID'])) {
	Goals::deleteGoal($_POST['deleteGoalID']);
}

if (isset($_POST['connect'])) {
	Goals::useContent($_POST['connectedGoalID'], $_POST['connectedContentID'], $_SESSION['userID'] );
}

//instans av db-uppkoppling
$mysqli = DB::getInstance();

//Update Password in DB
if (isset($_POST['userForUpdate']) && isset($_POST['updatedPassword'])) {
	Account::changePassword($_POST['userForUpdate'], $_POST['updatedPassword']);
	header('Location: http://192.168.33.10/Fantastic-Teaching/');
}

//Create account
if (isset($_POST['newUser'])) {
	Account::createAccount($_POST['newUsername'], $_POST['newPassword'], $_POST['allowedEmail']);
}

if (isset($_POST['login'])) {
	Account::logIn($_POST['username'], $_POST['password']);
}

//Om vi inte har inloggad användare - visa detta:
if (!isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Fantastic Teaching",
	]; //data-array till twig avslutas
}

//$content är alltid deklarerad nu annars fick man problem med visning.
$content = new Content();

$viewRating = $content->viewRating();
$viewArticleUses = $content->viewArticleUses();

if(isset($_POST['postContent'])){
	$content->addContent($_POST['title'], $_POST['subject'], $_POST['year'], $_POST['estimate'], $_POST['text'], $_FILES["fileToUpload"], $_POST['video'], $_SESSION['userID']);
	//after adding new content - go back to index.php so get values disappear
	header('Location: http://192.168.33.10/Fantastic-Teaching/');
}

if(isset($_POST['submitUp'])){
	$content->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitUp']);
}

if(isset($_POST['submitDown'])){
	$content->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitDown']);
}
$singleContent = NULL;
$allContent = NULL;
$getAllContentBTN = NULL;


if(isset($_POST['search'])){
	$allContent = $content->searchContent($_POST['search'], $_POST['searchSubject'], $_POST['searchYear']);
	$getAllContentBTN = TRUE;
}elseif(isset($_POST['viewSingleContent'])){
	$singleContent = $content->viewSingleContent($_POST['viewSingleContent']);
	$getAllContentBTN = TRUE;
}else{
	$allContent = $content->viewContent();
}

if(isset($_POST['goalUserID'])){
	Goals::addGoal($_POST['goal'], $_POST['subject'], $_POST['year'], $_POST['goalUserID']);
}

if(isset($_POST['showGoals'])){
	$goalsForm = TRUE;
}else{
	$goalsForm = NULL;
}

$goals = Goals::viewGoals($_SESSION['userID']);

if (isset($_POST['showConnections'])) {
	$connectedContent = Goals::showConnectedContent($_POST['showConnections'], $_SESSION['userID']);
	$estimateSum = Goals::sumEstimate($_POST['showConnections'], $_SESSION['userID']);
}else{
	$connectedContent = NULL;
}


//If we pressed link to publish form - show publish form by setting value to true, twig will render publishNew.html template
if (isset($_POST['publishNew'])) {
	$publishNew = TRUE;
}else{
	$publishNew = NULL;
}

if (isset($_GET['changePassword']) && isset($_SESSION['userID'])) {
	$changeUserTemplate = TRUE;
}else{
	$changeUserTemplate = NULL;
}
if (isset($_POST['showConnections'])) {
	$buttonId = $_POST['showConnections'];
}else{
	$buttonId = NULL;
}


//Om vi har inloggad användare - visa detta:
if (isset($_SESSION['userID'])) {
	//data twig använder (i array):
	$data= [
	'title' => "Fantastic Teaching",
	'allContent' => $allContent,
	'singleContent' => $singleContent,
	'user' => $_SESSION['username'],
	'sessionUserID' => $_SESSION['userID'],
	'userLevel' => $_SESSION['userLevel'],
	'publishNew' => $publishNew,
	'goalsForm' => $goalsForm,
	'buttonId' => $buttonId,
	'changeUser' => $changeUserTemplate,
	'connectedContent' => $connectedContent,
	'viewRating' => $viewRating,
	'viewArticleUses' => $viewArticleUses,
	'goals' => $goals,
	'estimateSum' => $estimateSum,
	'getAllContentBTN' => $getAllContentBTN
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
