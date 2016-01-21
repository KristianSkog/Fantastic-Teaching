<?php

class User {
	public static function home() {
		if (isset($_SESSION['userID'])) {
			require_once('Goals.model.php');
			require_once('Content.model.php');
			$contentMdl = new ContentModel();
			if(isset($_POST['submitUp'])){
				$contentMdl->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitUp']);
			}

			if(isset($_POST['submitDown'])){
				$contentMdl->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitDown']);
			}
		
			$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','content.html','footer.html'),
				'content' => $contentMdl->viewContent(),
				'userID' => $_SESSION['userID'],
				'user' => $_SESSION['username'],
				'userLevel' => $_SESSION['userLevel'],
				'viewRating' => $contentMdl->viewRating()
			);

			return $data;
		
		}else{
			$data = array(
				'templates'=>array('header.html','login.html','footer.html')
			);
			return $data;
		}
	}


	public static function profile() {

		if (isset($_SESSION['userID'])) {
			require_once('Goals.model.php');
			require_once('Content.model.php');
			$goalsMdl = new GoalsModel();
			$contentMdl = new ContentModel();
			
			$data = array(
					'templates'=>array('header.html','menu.html','viewArticleUses.html','goalsForm.html','goals.html','footer.html'),
					'goals' => $goalsMdl->viewGoals($_SESSION['userID']),
					'addGoal' => $goalsMdl->addGoal($_POST['goal'], $_POST['subject'], $_POST['year'], $_POST['goalUserID']),
					'viewArticleUses' => $contentMdl->viewArticleUses($_SESSION['userID']),	
					'userID' => $_SESSION['userID'],
					'user' => $_SESSION['username'],
					'userLevel' => $_SESSION['userLevel']
					);

			return $data;
		}else{
			$data = array(
				'templates'=>array('header.html','login.html','footer.html')
			);
			return $data;
		}
	}

	public static function changePassword() {
		if (isset($_SESSION['userID'])) {
			require_once('Goals.model.php');
			require_once('Content.model.php');
			$contentMdl = new ContentModel();
		
			$data = array(
				'templates'=>array('header.html','menu.html', 'changeUser.html','footer.html'),
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
}