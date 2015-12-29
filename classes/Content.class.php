<?php
class Content{

	function addContent($title, $text){
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();
	    $title = $mysqli->real_escape_string($title);
	    $text = $mysqli->real_escape_string($text);

	    // LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	    $sql="INSERT INTO content (title, text) VALUES ('$title','$text')";
	    $mysqli->query($sql);
	}

	function viewContent(){
		$mysqli = DB::getInstance();
	    
	     $query = "SELECT * FROM content";
   
	    $result = $mysqli->query($query);

	    $array = array();

	   while ($row = $result->fetch_assoc()) {
	       $array[] = $row;
	    }
	    return $array;
	}


	function searchContent($cleanSearch){
		$mysqli = DB::getInstance();
		$query = "
		SELECT *
		FROM content
		WHERE content.text LIKE '%".$cleanSearch."%'
		OR content.title LIKE '%".$cleanSearch."%'
		";
		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
	       $array[] = $row;
	    }
	    return $array;
	}

}


