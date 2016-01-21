<?php

class Content {

	public static function contentForm() {
		if (isset($_SESSION['userID'])) {

			$data = array(
				'templates'=>array('header.html','menu.html', 'publishNew.html','footer.html'),
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

	public static function add($url_parts) {
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$id = $url_parts[0];
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','footer.html'),
				'article' => $contentMdl->addContent($_POST['title'], $_POST['subject'], $_POST['year'], $_POST['estimate'], $_POST['text'], $_FILES["fileToUpload"], $_POST['video'], $_SESSION['userID']),
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID']
				);

		header('Location: /Fantastic-Teaching/?/User/home');
		return $data;
	}

	public static function delete($url_parts) {
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$id = $url_parts[0];
		$deleteContent = $contentMdl->deleteContent($_POST['deleteContentID']);
		$data = array(
				'templates'=>array('header.html','menu.html','footer.html'),
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID']
				);

		header('Location: /Fantastic-Teaching/?/User/home');
		return $data;
	}
	
	public static function view($url_parts) {
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$id = $url_parts[0];
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','singleContent.html','footer.html'),
				'article' => $contentMdl->viewSingleContent($id),
				'userLevel' => $_SESSION['userLevel'],
				'user' => $_SESSION['username'],
				'userID' => $_SESSION['userID']
				);

		return $data;
	}

		public static function search($url_parts) {
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