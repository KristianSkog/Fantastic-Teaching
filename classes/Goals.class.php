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


	static function deleteGoal($dirtyGoalID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);

		$mysqli = DB::getInstance();
	    
	    $query = "
	    DELETE
	    FROM goals
	    WHERE goals.id = '".$cleanGoalID."'
	    ";

	    $mysqli->query($query);
	}

	static function useContent($dirtyGoalID, $dirtyContentID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanContentID = Cleaner::cleanVar($dirtyContentID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();
	    
	    $query = "
	    INSERT INTO goals_use_content (goal_id, content_id, user_id)
	    VALUES ('$cleanGoalID','$cleanContentID','$cleanUserID')
	    ";

	    $mysqli->query($query);
	}

	static function showConnectedContent($dirtyGoalID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();

		$query = "
		select *
		from content, goals_use_content
		WHERE content.id = goals_use_content.content_id
		AND goals_use_content.goal_id = '".$cleanGoalID."'
		HAVING goals_use_content.user_id = '".$cleanUserID."'
		ORDER BY content.timestamp DESC
		";
   		$result = $mysqli->query($query);
		$array = array();

		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
	  	
		}
		
		return $array;
	}

}