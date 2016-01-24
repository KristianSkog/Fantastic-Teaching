<?php
class ContentModel{

	function addContent($dirtyTitle, $dirtySubject, $dirtyYear, $dirtyEstimate, $dirtyText, $fileToUpload, $dirtyVideo, $dirtyAuthorID){
		//takes variables from form and insert into database.

		$mysqli = DB::getInstance();

		//Washes those dirty variables
		$cleanTitle = Cleaner::cleanVar($dirtyTitle);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanEstimate = Cleaner::cleanVar($dirtyEstimate);
		$cleanText = Cleaner::cleanVar($dirtyText);
		$cleanVideo = Cleaner::cleanVar($dirtyVideo);
		$cleanAuthorID = Cleaner::cleanVar($dirtyAuthorID);

	//on video it separates whatever comes after "=" and puts it into videoID which is inserted into twigtemplate later.
		$videoAdress = explode('=', $cleanVideo);
		$videoID = $videoAdress[1];


	// takes the complete filename from $fileToUpload['name'] and separates the file-extension
	//then gives it a new name from uniqid()and then adds the extension. 
		if(!empty($fileToUpload['tmp_name'])){
			$originalFileName = basename($fileToUpload['name']);
			$fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
			$newFileName = uniqid().'.'.$fileExtension;

	// the file goes through a few checks before it is moved to the server folder. 
	// if it passes all tests and return true, it will be uploaded. otherwise not.

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

			if ($uploadCheck == TRUE) {
				move_uploaded_file($fileToUpload['tmp_name'], $target_file);
			}
		}
		else{
			$newFileName == NULL;
		}

		// adds into database.
	    $query = "
	    INSERT INTO content (title, subject, year, estimate, text, file, video, author_id)
	    VALUES ('$cleanTitle','$cleanSubject','$cleanYear','$cleanEstimate','$cleanText','$newFileName','$videoID','$cleanAuthorID')
	    ";

	    $mysqli->query($query);

	}

	function viewSingleContent($dirtyContentID){
	// takes contentID and looks for it in the database. if found return array value. 

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
	} 

	function viewContent(){
	// returns selected columns from content and limit the character to 150.
		$mysqli = DB::getInstance();

		$query = "
		SELECT content.id, content.title,
		content.subject, content.year, content.estimate,
		content.file, content.video,
		content.author_id,
		substring(content.text,1,150) as text,
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
	}

	function searchContent($dirtySearch, $dirtySubject, $dirtyYear){
	// takes post from searchform and search the database.
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanSearch = Cleaner::cleanVar($dirtySearch);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$mysqli = DB::getInstance();

		$query = "
		SELECT content.id,
		content.title,
		content.subject,
		content.year,
		content.estimate,
		content.file,
		content.video,
		content.author_id,
		content.text as 'fulltext',
		substring(content.text,1,150) as 'text',
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

	function deleteContent($dirtyContentID, $dirtyUserID){
	// takes contentID and userID and deletes it from database.
	//it will only delete rows containg both userID and contentID so that one cant delete someone elses content.
		$cleanContentID = Cleaner::cleanVar($dirtyContentID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();

	    $query = "
	    DELETE
	    FROM content
	    WHERE content.id = '".$cleanContentID."'
	    AND content.author_id = '".$cleanUserID."'
	    ";
	    
	    $mysqli->query($query);
	}

	function rating($dirtyContentID,$dirtyUserId,$dirtyRating){
	// takes contentID, userID and rating containing 1 or -1 and insert it into database.
	// it checks if that userID has rated on that content before. if no, it will insert rating into database.

		$cleanContentID = Cleaner::cleanVar($dirtyContentID);
		$cleanUserId = Cleaner::cleanVar($dirtyUserId);
		$cleanRating = Cleaner::cleanVar($dirtyRating);

		$mysqli = DB::getInstance();

		$query = "SELECT EXISTS(SELECT * FROM rating WHERE content_id = '$cleanContentID' and users_id = '$cleanUserId') as ratingExists";
		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {

	  		if($row['ratingExists'] == 0){

			  	$query = "
				INSERT INTO rating (content_id, users_id, rating)
				VALUES ('$cleanContentID', '$cleanUserId', '$cleanRating')
				";

				$mysqli->query($query);
			}
	  	}
	}//stänger rating


	function viewRating(){
	// sums the rating and displays it.
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

	static function viewArticleUses(){
	// looks in database how many times a content.id reccurs and then displays it.
	// it reccurs when someone uses that content in table goals_use_content.

	$mysqli = DB::getInstance();
	$query = "select content.author_id as user, content.title, count(content.id) as uses
			from content
			join users
			on content.author_id = users.id
			join goals_use_content
			on content.id = goals_use_content.content_id
			group by content.id
			";
	$result = $mysqli->query($query);
		$viewArticleUses = array();
		while ($row = $result->fetch_assoc()) {
			$viewArticleUses[] = $row;
		}

		return $viewArticleUses;
	}

}
