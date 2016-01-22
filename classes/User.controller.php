<?php

class User {
	public static function home() {
			require_once('Goals.model.php');
			require_once('Content.model.php');
			$contentMdl = new ContentModel();
			
			$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','content.html','footer.html'),
				'content' => $contentMdl->viewContent(),
				'userID' => $_SESSION['userID'],
				'user' => $_SESSION['username'],
				'userLevel' => $_SESSION['userLevel'],
				'viewRating' => $contentMdl->viewRating()
			);

			return $data;
	}


	public static function profile() {
			require_once('Goals.model.php');
			require_once('Content.model.php');
			$goalsMdl = new GoalsModel();
			$contentMdl = new ContentModel();
			
			$data = array(
					'templates'=>array('header.html','profile.html','menu.html','goals.html','viewArticleUses.html','footer.html'),
					'goals' => $goalsMdl->viewGoals($_SESSION['userID']),
					'viewArticleUses' => $contentMdl->viewArticleUses($_SESSION['userID']),	
					'userID' => $_SESSION['userID'],
					'user' => $_SESSION['username'],
					'userLevel' => $_SESSION['userLevel']
					);

			return $data;
	}

	public static function changePassword() {
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
	}
}