// <?php
// class Page{

// 	static function home(){

// 		if (isset($_SESSION['userID'])) {

// 			//$content är alltid deklarerad nu annars fick man problem med visning.
// 			$content = new Content();

// 			//om logga ut finns i get - unsetta innan något printas på sajten
// 			/*if (isset($_POST['logout'])){
// 				session_unset();

// 				header('Location: /Fantastic-Teaching/');
// 		}*/

// 			if (isset($_POST['deleteContentID'])) {
// 				$content->deleteContent($_POST['deleteContentID']);
// 			}

// 			if(isset($_POST['submitUp'])){
// 				$content->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitUp']);
// 			}

// 			if(isset($_POST['submitDown'])){
// 				$content->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitDown']);
// 			}
// 			if(isset($_POST['postContent'])){
// 				$content->addContent($_POST['title'], $_POST['subject'], $_POST['year'], $_POST['estimate'], $_POST['text'], $_FILES["fileToUpload"], $_POST['video'], $_SESSION['userID']);
// 				//after adding new content - go back to index.php so get values disappear
// 				header('Location: /Fantastic-Teaching/?/Page/home');
// 			}

			
// 			if (isset($_POST['connect'])) {
// 				Goals::useContent($_POST['connectedGoalID'], $_POST['connectedContentID'], $_SESSION['userID'] );
// 			}

// 			$viewRating = $content->viewRating();
// 			// $viewArticleUses = $content->viewArticleUses();

// 			$singleContent = NULL;
// 			$allContent = NULL;
// 			$getAllContentBTN = NULL;
// 			print_r($goals = Goals::viewGoals($_SESSION['userID']));


// 			if(isset($_POST['search'])){
// 				$allContent = $content->searchContent($_POST['search'], $_POST['searchSubject'], $_POST['searchYear']);
// 				$getAllContentBTN = TRUE;
// 			}elseif(isset($_POST['viewSingleContent'])){
// 				$singleContent = $content->viewSingleContent($_POST['viewSingleContent']);
// 				$getAllContentBTN = TRUE;
// 			}else{
// 				$allContent = $content->viewContent();
// 			}
// 			//If we pressed link to publish form - show publish form by setting value to true, twig will render publishNew.html template
// 			if (isset($_POST['publishNew'])) {
// 				$publishNew = TRUE;
// 			}else{
// 				$publishNew = NULL;
// 			}


// 			return $data = [
// 			'template' => 'home.html',
// 			'title' => "Fantastic Teaching",
// 			'allContent' => $allContent,
// 			'singleContent' => $singleContent,
// 			'user' => $_SESSION['username'],
// 			'sessionUserID' => $_SESSION['userID'],
// 			'userLevel' => $_SESSION['userLevel'],
// 			'publishNew' => $publishNew,
// 			// 'goalsForm' => $goalsForm,
// 			// 'buttonId' => $buttonId,
// 			// 'changeUser' => $changeUserTemplate,
// 			'connectedContent' => $connectedContent,
// 			'viewRating' => $viewRating,
// 			'search' => TRUE,
// 			'goals' => $goals,
// 			'admin' => TRUE,
// 			// 'goals' => $goals,
// 			// 'estimateSum' => $estimateSum,
// 			'getAllContentBTN' => $getAllContentBTN
// 		]; //data-array till twig avslutas

// 			echo "homepage";
// 		}else{
// 			header('Location: /Fantastic-Teaching/');
// 		}

// 	}

// 	static function goals(){
// 		if (isset($_SESSION['userID'])) {
// 			if (isset($_POST['deleteGoalID'])) {
// 				Goals::deleteGoal($_POST['deleteGoalID']);
// 			}

// 			if (isset($_POST['deleteConnectionID'])) {
// 				Goals::deleteConnection($_POST['deleteConnectionID']);
// 			}

// 			if(isset($_POST['goalUserID'])){
// 				Goals::addGoal($_POST['goal'], $_POST['subject'], $_POST['year'], $_POST['goalUserID']);
// 			}

// 			if(isset($_POST['showGoals'])){
// 				$goalsForm = TRUE;
// 			}else{
// 				$goalsForm = NULL;
// 			}

// 			$goals = Goals::viewGoals($_SESSION['userID']);

// 			if (isset($_POST['showConnections'])) {
// 				$connectedContent = Goals::showConnectedContent($_POST['showConnections'], $_SESSION['userID']);
// 				$estimateSum = Goals::sumEstimate($_POST['showConnections'], $_SESSION['userID']);
// 			}else{
// 				$connectedContent = NULL;
// 				$estimateSum = NULL;
// 			}
// 			if (isset($_POST['showConnections'])) {
// 				$buttonId = $_POST['showConnections'];
// 			}else{
// 				$buttonId = NULL;
// 			}

// 			return $data = [
// 			'template' => 'goals.html',
// 			'title' => "Fantastic Teaching",
// 			// 'allContent' => $allContent,
// 			// 'singleContent' => $singleContent,
// 			'user' => $_SESSION['username'],
// 			'sessionUserID' => $_SESSION['userID'],
// 			'userLevel' => $_SESSION['userLevel'],
// 			// 'publishNew' => $publishNew,
// 			'goalsForm' => $goalsForm,
// 			'buttonId' => $buttonId,
// 			// 'changeUser' => $changeUserTemplate,
// 			'connectedContent' => $connectedContent,
// 			// 'viewRating' => $viewRating,
// 			// 'viewArticleUses' => $viewArticleUses,
// 			'goals' => $goals,
// 			'admin' => TRUE,
// 			'estimateSum' => $estimateSum,
// 			// 'getAllContentBTN' => $getAllContentBTN
// 			]; //data-array till twig avslutas
// 		}else{
// 			header('Location: /Fantastic-Teaching/');
// 		}

// 	}

// 	static function menu(){
// 		if (isset($_SESSION['userID'])) {

// 			if (isset($_POST['logout'])){
// 				session_unset();

// 				header('Location: /Fantastic-Teaching/');
// 			}

// 			//Update Password in DB
// 			if (isset($_POST['userForUpdate']) && isset($_POST['updatedPassword'])) {
// 				Account::changePassword($_POST['userForUpdate'], $_POST['updatedPassword']);
// 				header('Location: /Fantastic-Teaching/');
// 			}

// 			//Create account
// 			if (isset($_POST['newUser'])) {
// 				Account::createAccount($_POST['newUsername'], $_POST['newPassword'], $_POST['allowedEmail']);
// 			}

			

// 			if (isset($_POST['changePassword']) && isset($_SESSION['userID'])) {
// 				$changeUserTemplate = TRUE;

// 			}else{
// 				$changeUserTemplate = FALSE;

// 			}

// 			return $data = [
// 				'template' => 'menu.html',
// 			'title' => "Fantastic Teaching",
// 			'admin' => TRUE,
// 			// 'allContent' => $allContent,
// 			// 'singleContent' => $singleContent,
// 			'user' => $_SESSION['username'],
// 			'sessionUserID' => $_SESSION['userID'],
// 			'userLevel' => $_SESSION['userLevel'],
// 			// 'publishNew' => $publishNew,
// 			// 'goalsForm' => $goalsForm,
// 			// 'buttonId' => $buttonId,
// 			'changeUser' => $changeUserTemplate,
// 			// 'connectedContent' => $connectedContent,
// 			// 'viewRating' => $viewRating,
// 			// 'viewArticleUses' => $viewArticleUses,
// 			// 'goals' => $goals,
// 			// 'estimateSum' => $estimateSum,
// 			// 'getAllContentBTN' => $getAllContentBTN
// 			]; //data-array till twig avslutas
// 		}else{
// 			header('Location: /Fantastic-Teaching/');
// 		}


// 	}

// 	static function login(){
// 			// require_once("classes/Account.class.php");
// 			// require_once("classes/Cleaner.class.php");
// 			// $logIn = Account::logIn($_POST['username'], $_POST['password']);
// 			// return header('Location: /Fantastic-Teaching/?/Page/home');

// 		// $data = [
// 		// 'title' => "Fantastic Teaching",
// 		// 'admin' => TRUE,
// 		// // 'allContent' => $allContent,
// 		// // 'singleContent' => $singleContent,
// 		// 'user' => $_SESSION['username'],
// 		// 'sessionUserID' => $_SESSION['userID'],
// 		// 'userLevel' => $_SESSION['userLevel'],
// 		// // 'publishNew' => $publishNew,
// 		// // 'goalsForm' => $goalsForm,
// 		// // 'buttonId' => $buttonId,
// 		// 'changeUser' => $changeUserTemplate,
// 		// // 'connectedContent' => $connectedContent,
// 		// // 'viewRating' => $viewRating,
// 		// // 'viewArticleUses' => $viewArticleUses,
// 		// // 'goals' => $goals,
// 		// // 'estimateSum' => $estimateSum,
// 		// // 'getAllContentBTN' => $getAllContentBTN
// 		// ]; //data-array till twig avslutas

// 	}


// }
