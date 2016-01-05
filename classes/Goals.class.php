<?php
class Goals{

	static function addGoal($dirtyGoal, $dirtySubject, $dirtyYear, $dirtyUserID){
		
		//instans av db-uppkoppling
		$mysqli = DB::getInstance();

		//Washes those dirty variables
		$cleanGoal = Cleaner::cleanVar($dirtyGoal);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

	    // LÄGGER TILL I DATABASEN PÅ VALDA POSITIONER
	    $query = 
	    "INSERT INTO goals (goal, subject, year, user_id) 
	    VALUES ('$cleanGoal','$cleanSubject','$cleanYear','$cleanUserID')";
	    $mysqli->query($query);

	}//stänger funktion


	static function viewGoals($dirtyUserID){
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();
	    
	     $query = "
	     SELECT * 
	     FROM goals
	     WHERE goals.user_id = '".$cleanUserID."'
	     ";
   
	    $result = $mysqli->query($query);

	    $array = array();

	   while ($row = $result->fetch_assoc()) {
	       $array[] = $row;
	    }
	    return $array;
	}

}