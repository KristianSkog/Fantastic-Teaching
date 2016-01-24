<?php
class UsingModel{

	static function viewArticleUses(){
	// looks in database how many times a content.id reccurs and then displays it.
	// it reccurs when someone uses that content in table goals_use_content.

	$mysqli = DB::getInstance();
	$query = "select content.id, content.author_id as user, content.title, count(content.id) as uses
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

	static function useContent($dirtyGoalID, $dirtyContentID, $dirtyUserID){
	// takes POST about goalID and contentID and session userID and insert that into database.
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

	static function deleteConnection($dirtyConnectionID, $dirtyUserID){
		// takes connectionID and userID and deletes that row from database that contains both.

		$cleanConnectionID = Cleaner::cleanVar($dirtyConnectionID);
		$cleanUserID = Cleaner::cleanVar($dirtyUserID);

		$mysqli = DB::getInstance();

	    $query = "
	    UPDATE goals_use_content
		SET user_id = NULL, goal_id = NULL
		WHERE goals_use_content.id = '".$cleanConnectionID."'
		AND goals_use_content.user_id = '".$cleanUserID."'
		";

	    $mysqli->query($query);
	}

	static function showConnectedContent($dirtyGoalID, $dirtyUserID){
		// takes POST about goalID and userID and shows the content that has both values

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

}