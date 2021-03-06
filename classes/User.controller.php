<?php

class User {
	//Page to load depending on get veriable.
	// Each method returns what templates to load and some twig variables for index.html and the templates to read.


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
			require_once('Using.model.php');
			$goalsMdl = new GoalsModel();
			$usingMdl = new UsingModel();
			if ($_SESSION['userLevel']== "Premium") {
				$data = array(
					'templates'=>array('header.html','menu.html','admin.html','goals.html','viewArticleUses.html','footer.html'),
					'goals' => $goalsMdl->viewGoals($_SESSION['userID']),
					'viewArticleUses' => $usingMdl->viewArticleUses($_SESSION['userID']),	
					'userID' => $_SESSION['userID'],
					'user' => $_SESSION['username'],
					'userLevel' => $_SESSION['userLevel']
					);
			}elseif ($_SESSION['userLevel'] == "Free") {
				$data = array(
					'templates'=>array('header.html','menu.html','admin.html','footer.html'),
					'userID' => $_SESSION['userID'],
					'user' => $_SESSION['username'],
					'userLevel' => $_SESSION['userLevel']
					);
			}

			return $data;
	}

	public static function changePassword() {
			
			$data = array(
				'templates'=>array('header.html','menu.html', 'changeUser.html','footer.html'),
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username']
			);

			return $data;
	}
}