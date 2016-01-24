<?php

class GoalsController {
	// Page to load depending on GET variable.


	public static function goalsForm() {
			//method returns what templates to load and some twig variables for index.html and the templates to read.

			require_once('Goals.model.php');
			$goalsMdl = new GoalsModel();
			$data = array(
				'templates'=>array('header.html','menu.html', 'goalsForm.html','footer.html'),
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username']
			);

			return $data;
	}

	public static function add() {
	// method sends information to Goals.model when a form sends post here.
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$create = $goalsMdl->addGoal($_POST['goal'], $_POST['subject'], $_POST['year'], $_POST['goalUserID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}

	public static function delete() {
	// method sends information to goals.model when a form sends posts here.
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$delete = $goalsMdl->deleteGoal($_POST['deleteGoalID'], $_SESSION['userID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}

	public static function goals() {
	//method returns what templates to load and some twig variables for index.html and the templates to read.
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		
		$data = array(
				'templates' => array('header.html','menu.html','goals.html','footer.html'),
				'goals' => $goalsMdl->viewGoals($_SESSION['userID']),	
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel']
				
				);
		return $data;
	}

	public static function singleGoal($url_parts) {
	//method returns what templates to load and some twig variables for index.html and the templates to read. 
	// compares what userID you have and returns goals connected to that userID
	//gives singlegoal method an content id from GET and the userID from session and puts what it returns in 'singleGoal' 
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$id = $url_parts[0];

		$data = array(
				'templates' => array('header.html','menu.html','singleGoal.html','footer.html'),
				'goals' => $goalsMdl->viewGoals($_SESSION['userID']),	
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'singleGoal' => $goalsMdl->showSingleGoal($id, $_SESSION['userID'])
				);
		return $data;
	}

}