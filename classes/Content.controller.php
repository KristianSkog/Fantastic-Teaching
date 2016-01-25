<?php

class Content {

	public static function contentForm() {
	//method returns what templates to load and some twig variables for index.html and the templates to read. 

			$data = array(
				'templates'=>array('header.html','menu.html', 'publishNew.html','footer.html'),
				'userID' => $_SESSION['userID'],
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username']
			);

			return $data;
	}

	public static function add() {
	//method returns what templates to load and some twig variables for index.html and the templates to read. 
	//sends info to add method in content.model on what content to add into database
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$contentMdl->addContent($_POST['title'], $_POST['subject'], $_POST['year'], $_POST['estimate'], $_POST['text'], $_FILES["fileToUpload"], $_POST['video'], $_SESSION['userID']);
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','footer.html'),
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID']
				);

		header('Location: /Fantastic-Teaching/?/User/home');
		return $data;
	}

	public static function delete() {
	// sends info to deleteContent method in content.model on what to delete.
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$contentMdl->deleteContent($_POST['deleteContentID'], $_SESSION['userID']);
		

		header('Location: /Fantastic-Teaching/?/User/home');
		return $data;
	}

	public static function rate() {
	// sends info to rating method in content.model on what to rate on what rating.
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		
		if(isset($_POST['submitUp'])) $rateContent = $contentMdl->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitUp']);
		if(isset($_POST['submitDown'])) $rateContent = $contentMdl->rating($_POST['contentRatingId'], $_POST['userRatingId'], $_POST['submitDown']);

		header('Location: /Fantastic-Teaching/?/User/home');
		return $data;
	}
	
	public static function view($url_parts) {
	//method returns what templates to load and some twig variables for index.html and the templates to read. 
		require_once('Content.model.php');
		require_once('Goals.model.php');
		$contentMdl = new ContentModel();
		$goalsMdl = new GoalsModel();
		$id = $url_parts[0];
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','singleContent.html','footer.html'),
				'goals' => $goalsMdl->viewGoals($_SESSION['userID']),
				'article' => $contentMdl->viewSingleContent($id),
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID'],
				'viewRating' => $contentMdl->viewRating()
				);

		return $data;
	}

		public static function search() {
	// sends info to search method in content.model on what to search for
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','content.html','footer.html'),
				'content' => $contentMdl->searchContent($_POST['search'], $_POST['searchSubject'], $_POST['searchYear']),
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID']
				);

		return $data;
	}
}