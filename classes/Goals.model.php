<?php
class GoalsModel{

	static function addGoal($dirtyGoal, $dirtySubject, $dirtyYear, $dirtyUserID){
	// takes post from goal, subject, year and Userid from session. and puts it into database. 
		

		$mysqli = DB::getInstance();

		$cleanGoal = Cleaner::cleanVar($dirtyGoal);
		$cleanSubject = Cleaner::cleanVar($dirtySubject);
		$cleanYear = Cleaner::cleanVar($dirtyYear);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

	    $query = 
	    "INSERT INTO goals (goal, subject, year, user_id) 
	    VALUES ('$cleanGoal','$cleanSubject','$cleanYear','$cleanUserID')";
	    $mysqli->query($query);

	}

	static function deleteGoal($dirtyGoalID, $dirtyUserID){
	// takes goalID and session userID and deletes from database that row that contains both of the values. no action if only one of them is found.

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

	static function viewGoals($dirtyUserID){
		// takes session userID and selects goals that has the same userID

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

	static function showSingleGoal($dirtyGoalID, $dirtyUserID){
	// takes POST about goalID and session userID and shows goal that contains both from database.
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
		
		return ['items' => $array, 'goal' => $array[0]['goal'], 'goal_subject' => $array[0]['goal_subject'], 'goal_year' => $array[0]['goal_year'],'goal_id' => $array[0]['goal_id']];

	}
// function to be implemented later that sums the time for your goal.
	// static function sumEstimate($dirtyGoalID, $dirtyUserID){
	// // takes goalID and userID and shows the sum from all rows regarding time estimate. 
	// 	$cleanGoalID = Cleaner::cleanVar($dirtyGoalID);
	// 	$cleanUserID = Cleaner::cleanVar($dirtyUserID);
	// 	$mysqli = DB::getInstance();
	// 	$query = "
	// 		SELECT *, SUM(content.estimate) as estimate
	// 		FROM content, goals_use_content
	// 		WHERE goals_use_content.goal_id = '".$cleanGoalID."'
	// 		AND goals_use_content.user_id = '".$cleanUserID."'
	// 		AND content.id = goals_use_content.content_id
	// 		";
		
	// 	$result = $mysqli->query($query);
	// 	$array = array();
	// 	while ($row = $result->fetch_assoc()) {
	// 		$array[] = $row;
	// 	}
	// 	return $array;
		
	// }

}