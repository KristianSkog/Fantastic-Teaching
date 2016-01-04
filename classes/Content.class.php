<?php
class Content{

	function addContent($dirtyTitle, $dirtySubject, $dirtyYear, $dirtyText, $fileUpload){
		//instans av db-uppkoppling


		$mysqli = DB::getInstance();

		//variabler för filuppladdning
		$tempName = $fileUpload['tmp_name'];
		$filename  = basename($fileUpload['name']);
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$newName       = md5($filename).'.'.$extension;

		$target_dir = "uploads/";
		$target_file = $target_dir . $newName;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		//Washes those dirty variables
		$cleanTitle = Cleaner::cleanVar($dirtyTitle);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanText = Cleaner::cleanVar($dirtyText);

	    // LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	    $query = "INSERT INTO content (title, subject, year, text, file) VALUES ('$cleanTitle','$cleanSubject','$cleanYear','$cleanText','$newName')";
	    $mysqli->query($query);

		//ladda upp fil

	    if(!empty($fileUpload['tmp_name'])) {
	    $check = getimagesize($fileUpload['tmp_name']);
	    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
	    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    
		    $uploadOk = 0;
		}
		// Check file size
		if ($fileUpload['size'] > 50000000) {
		    
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($fileUpload['tmp_name'], $target_file)) {
		        //echo "The file ". basename( $upload['tmp_name']). " has been uploaded.";
		    } else {

		    }
		}

	}//stänger funktion


	function viewContent(){
		$mysqli = DB::getInstance();
	    
	     $query = "SELECT * FROM content ORDER BY timestamp DESC";
   
	    $result = $mysqli->query($query);

	    $array = array();

	   while ($row = $result->fetch_assoc()) {
	       $array[] = $row;
	    }
	    return $array;
	}


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
	}

	function addFile($upload){

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($upload['name']);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST['addFile'])) {
		    $check = getimagesize($upload['tmp_name']);
		    if($check !== false) {
		        //echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        //echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    
		    $uploadOk = 0;
		}
		// Check file size
		if ($upload['size'] > 50000000) {
		    
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($upload['tmp_name'], $target_file)) {
		        //echo "The file ". basename( $upload['tmp_name']). " has been uploaded.";
		    } else {

		    }
		}
		
	}



}//Close class


