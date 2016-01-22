<?php

class GoalsController {

	public static function goalsForm() {
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
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$create = $goalsMdl->addGoal($_POST['goal'], $_POST['subject'], $_POST['year'], $_POST['goalUserID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}

	public static function delete() {
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$delete = $goalsMdl->deleteGoal($_POST['deleteGoalID'], $_SESSION['userID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}

	public static function goals() {
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

	public static function createConnection() {
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$createConnection = $goalsMdl->useContent($_POST['connectedGoalID'], $_POST['connectedContentID'], $_SESSION['userID'] );
		header('Location: /Fantastic-Teaching/?/GoalsController/singleGoal/'.$_POST['connectedGoalID'].'');
		
	}

	public static function deleteConnection() {
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		$deleteConnection = $goalsMdl->deleteConnection($_POST['deleteConnectionID'], $_SESSION['userID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}
}