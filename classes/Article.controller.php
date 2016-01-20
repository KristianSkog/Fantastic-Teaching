<?php

class Article {
	public static function view($url_parts) {
		require_once('Content.model.php');
		$contentMdl = new ContentModel();
		$id = $url_parts[0];
				
		$data = array(
				'templates'=>array('header.html','menu.html', 'searchForm.html','singleContent.html','footer.html'),
				'article' => $contentMdl->viewSingleContent($id),
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
				'userID' => $_SESSION['userID']
				);

		return $data;
	}
}