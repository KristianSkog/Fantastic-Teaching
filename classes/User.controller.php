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
		/*
		$data['templates'] = array('header.html');
		if(isset($_SESSION['userID']))
			$data['templates'][] = "test.html";
		else 
			$data['templates'][] = "login.html";
		$data['templates'][] = 'footer.html';
		return $data;
		*/
	}


	public static function profile() {

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
				'userLevel' => $_SESSION['userLevel'],
				
				);

		return $data;
		/*
		$data['templates'] = array('header.html');
		if(isset($_SESSION['userID']))
			$data['templates'][] = "test.html";
		else 
			$data['templates'][] = "login.html";
		$data['templates'][] = 'footer.html';
		return $data;
		*/
	}


	public static function login() {

	}
}