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


	}//stänger addContent

	//viewcontent stoppar in alla resultat i en array. denna array loopar vi igenom i twig sedan.
	function viewContent(){
		$mysqli = DB::getInstance();
	    
	     $sql = "SELECT * FROM content";
   
	    $result = $mysqli->query($sql);

	    $array = array();

	   while ($row = $result->fetch_assoc()) {
	       $array[] = $row;
	    }
	    return $array;

	}

}//stänger klassen
?>


