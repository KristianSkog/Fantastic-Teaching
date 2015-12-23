<?php
class Content{

		function addContent($title, $text){
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
	    $title = $mysqli->real_escape_string($title);
	    $text = $mysqli->real_escape_string($text);

	    // LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	    $sql="INSERT INTO content (title, text) VALUES ('$title','$text')";
	}//stänger addContent

}//stänger klassen
?>


