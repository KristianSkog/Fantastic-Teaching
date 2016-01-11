<?php
class Content{

	function addContent($dirtyTitle, $dirtySubject, $dirtyYear, $dirtyText, $fileToUpload, $dirtyVideo, $dirtyAuthorID){
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();

		//Washes those dirty variables
		$cleanTitle = Cleaner::cleanVar($dirtyTitle);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanText = Cleaner::cleanVar($dirtyText);
		$cleanVideo = Cleaner::cleanVar($dirtyVideo);
		$cleanAuthorID = Cleaner::cleanVar($dirtyAuthorID);


		$videoAdress = explode('=', $cleanVideo);
		$videoID = $videoAdress[1];


		//ladda upp fil
		if(!empty($fileToUpload['tmp_name'])){
			$originalFileName = basename($fileToUpload['name']);
			$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
			$newFileName = uniqid().'.'.$fileExtension;

			$target_dir = "uploads/";
			$target_file = $target_dir . $newFileName;
			$uploadCheck = TRUE;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

	    if(!empty($fileToUpload['tmp_name'])) {
	    $check = getimagesize($fileToUpload['tmp_name']);
	    if($check !== FALSE) {
        $uploadCheck = TRUE;
	    } else {
        $uploadCheck = FALSE;
		    }
			}

			// Allow certain file formats, Check file size
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" && $fileToUpload['size'] > 50000000) {
			    $uploadCheck = FALSE;
			}
			// Check if $uploadCheck is set to 0 by an error
			if ($uploadCheck == TRUE) {
				move_uploaded_file($fileToUpload['tmp_name'], $target_file);
			}
		}//stänger ifsats om $fileToUpload är tom.
		else{
			$newFileName == NULL;
		}

		// LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	    $query = "
	    INSERT INTO content (title, subject, year, text, file, video, author_id)
	    VALUES ('$cleanTitle','$cleanSubject','$cleanYear','$cleanText','$newFileName','$videoID','$cleanAuthorID')
	    ";

	    $mysqli->query($query);

	}//stänger addContent funktion

	function viewSingleContent($dirtyContentID){
		$cleanContentID = Cleaner::cleanVar($dirtyContentID);

		$mysqli = DB::getInstance();

		$query = "
		SELECT content.*, users.username
		FROM content
		JOIN users
		ON content.author_id = users.id
		WHERE content.id = ".$cleanContentID;

   		$result = $mysqli->query($query);
		$array = array();

		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
	  }
	  return $array;
	} // stänger viewContent funktion

	function viewContent(){
		$mysqli = DB::getInstance();

		$query = "
		SELECT content.id, content.title,
		content.subject, content.year,
		content.file, content.video,
		content.author_id,
		substring(content.text,1,50) as text,
		users.username
		FROM content
		JOIN users
		ON content.author_id = users.id
		ORDER BY content.timestamp DESC
		";
   		$result = $mysqli->query($query);
		$array = array();

		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
	  }
	  return $array;
	} // stänger viewContent funktion

	function searchContent($dirtySearch, $dirtySubject, $dirtyYear){
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanSearch = Cleaner::cleanVar($dirtySearch);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$mysqli = DB::getInstance();

		$query = "
		SELECT content.id, 
		content.title, 
		content.subject, 
		content.year, 
		content.file, 
		content.video, 
		content.author_id, 
		content.text as 'fulltext', 
		substring(content.text,1,50) as 'text', 
		users.username
		FROM users
		JOIN content
		ON users.id = content.author_id
		WHERE CONCAT(content.subject, content.year) LIKE '%".$cleanSubject.$cleanYear."%'
		HAVING content.title LIKE '%".$cleanSearch."%'
		OR content.text  LIKE '%".$cleanSearch."%'
		ORDER BY content.timestamp DESC
		";

		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
	  }
	  return $array;
	}// stänger searchContent funktion

	static function deleteContent($dirtyContentID){
		$cleanContentID = Cleaner::cleanVar($dirtyContentID);

		$mysqli = DB::getInstance();

	    $query = "
	    DELETE
	    FROM content
	    WHERE content.id = '".$cleanContentID."'
	    ";

	    $mysqli->query($query);
	}

	function rating($dirtyContentID,$dirtyUserId,$dirtyRating){

		$cleanContentID = Cleaner::cleanVar($dirtyContentID);
		$cleanUserId = Cleaner::cleanVar($dirtyUserId);
		$cleanRating = Cleaner::cleanVar($dirtyRating);

		$mysqli = DB::getInstance();

		$query = "
		INSERT INTO rating (content_id, users_id, rating)
		VALUES ('$cleanContentID', '$cleanUserId', '$cleanRating')
		";

		$mysqli->query($query);
	}

	function viewRating(){
		$mysqli = DB::getInstance();
		$query = "
			select content_id, sum(rating) as rating
			from rating
			group by content_id
		";

		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
			$array[] = $row;
		}
		return $array;
	}

}//Close class
