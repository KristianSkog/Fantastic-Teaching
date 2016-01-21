<?php

class GoalsController {

	public static function goalsForm() {
		if (isset($_SESSION['userID'])) {
			require_once('Goals.model.php');
			$goalsMdl = new GoalsModel();
			$data = array(
				'templates'=>array('header.html','menu.html', 'goalsForm.html','footer.html'),
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username']
			);

			return $data;
		
		}else{
			$data = array(
				'templates'=>array('header.html','login.html','footer.html')
			);
			return $data;
		}
	}

	public static function goals() {
		require_once('Goals.model.php');
		$goalsMdl = new GoalsModel();
		
		$data = array(
				'templates' => array('header.html','menu.html','goalsForm.html','goals.html','footer.html'),
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

var_dump($_SESSION['userID']);
		$data = array(
				'templates' => array('header.html','menu.html','goalsForm.html','singleGoal.html','footer.html'),
				'goals' => $goalsMdl->viewGoals($_SESSION['userID']),	
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'singleGoal' => $goalsMdl->showSingleGoal($id, $_SESSION['userID'])
				);
		return $data;
	}
}