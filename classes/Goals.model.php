<?php
class GoalsModel{

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

	   while ($rowGoals = $result->fetch_assoc()) {
	       $array[] = $rowGoals;
	    }
	    return $array;
	}


	static function deleteGoal($dirtyGoalID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();
	    //check session['userID'] if you are the creator of the goal that you are trying to delete.
	    $query = "
	    DELETE
	    FROM goals
	    WHERE goals.id = '".$cleanGoalID."'
	    AND goals.user_id = '".$cleanUserID."'
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
	static function showSingleGoal($dirtyGoalID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();

		$query = "
			SELECT content.*, goals_use_content.id as 'connection_id', goals.id as 'goal_id', goals.goal, goals.subject as 'goal_subject', goals.year as 'goal_year', goals.user_id as 'goal_user_id'
			from goals
			left join goals_use_content
			on goals.id = goals_use_content.goal_id
			left join content
			on goals_use_content.content_id = content.id
			where goals.user_id = '".$cleanUserID."'
			and goals.id = '".$cleanGoalID."'
		";
			
		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
	  	$array[] = $row;
		}
		
		return ['items' => $array, 'goal' => $array[0]['goal'], 'goal_subject' => $array[1]['goal_subject'], 'goal_year' => $array[2]['goal_year'],'goal_id' => $array[3]['goal_id']];

	}

	static function showConnectedContent($dirtyGoalID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();

		$queryConnections = "
		SELECT *
		FROM content, goals_use_content
		WHERE content.id = goals_use_content.content_id
		AND goals_use_content.goal_id = '".$cleanGoalID."'
		HAVING goals_use_content.user_id = '".$cleanUserID."'
		ORDER BY content.timestamp DESC
		";
   		$resultConnections = $mysqli->query($queryConnections);
		$array = array();
		while ($rowConnections = $resultConnections->fetch_assoc()) {
	  	$array[] = $rowConnections;
		}
		
		return $array;
	}

	static function deleteConnection($dirtyConnectionID){
		$cleanConnectionID = Cleaner::cleanVar($dirtyConnectionID);

		$mysqli = DB::getInstance();

	    $query = "
	    DELETE
	    FROM goals_use_content
	    WHERE goals_use_content.id = '".$cleanConnectionID."'
	    ";

	    $mysqli->query($query);
	}

	static function sumEstimate($dirtyGoalID, $dirtyUserID){
		$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);
		$mysqli = DB::getInstance();
		$query = "
			SELECT *, SUM(content.estimate) as estimate
			FROM content, goals_use_content
			WHERE goals_use_content.goal_id = '".$cleanGoalID."'
			AND goals_use_content.user_id = '".$cleanUserID."'
			AND content.id = goals_use_content.content_id
			";
		
		$result = $mysqli->query($query);
		$array = array();
		while ($row = $result->fetch_assoc()) {
			$array[] = $row;
		}
		return $array;
		
	}

}