<?php
class Content{

	function addContent($dirtyTitle, $dirtySubject, $dirtyYear, $dirtyText, $fileToUpload, $dirtyVideo){
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();

		//Washes those dirty variables
		$cleanTitle = Cleaner::cleanVar($dirtyTitle);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanText = Cleaner::cleanVar($dirtyText);
		$cleanVideo = Cleaner::cleanVar($dirtyVideo);

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
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadCheck = TRUE;
	    } else {
        //echo "File is not an image.";
        $uploadCheck = FALSE;
		    }
			}

			// Allow certain file formats, Check file size
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" && $fileToUpload['size'] > 50000000) {
			    $uploadCheck = FALSE;
			}
			// Check if $uploadCheck is set to 0 by an error
			if ($uploadCheck == FALSE) {
				move_uploaded_file($fileToUpload['tmp_name'], $target_file);
			}
		}//stänger ifsats om $fileToUpload är tom.

		// LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	  $query = "INSERT INTO content (title, subject, year, text, file, video) VALUES ('$cleanTitle','$cleanSubject','$cleanYear','$cleanText','$newFileName','$cleanVideo')";
	  $mysqli->query($query);

	}//stänger addContent funktion

	function viewContent(){
		$mysqli = DB::getInstance();

	  $query = "SELECT * FROM content ORDER BY timestamp DESC";
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
			SELECT *
			FROM content
			WHERE content.subject = '".$cleanSubject."'
			AND content.year = '".$cleanYear."'
			HAVING content.title LIKE '%".$cleanSearch."%'
			OR content.text LIKE '%".$cleanSearch."%'
			ORDER BY timestamp DESC
			";

		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
	  }
	  return $array;
	}// stänger searchContent funktion

}//Close class
