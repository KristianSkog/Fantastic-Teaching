<?php

class Using {
	// Page to load depending on GET variable.
	

	public static function createConnection() {
	// gives useContent method in Using.model goalID, contentID and userID.
		require_once('Using.model.php');
		$usingMdl = new UsingModel();
		$usingMdl->useContent($_POST['connectedGoalID'], $_POST['connectedContentID'], $_SESSION['userID'] );
		header('Location: /Fantastic-Teaching/?/GoalsController/singleGoal/'.$_POST['connectedGoalID'].'');
	}

	public static function deleteConnection() {
	// gives deleteConntection in Using.model content id and user id and deletes it from database.
		require_once('Using.model.php');
		$usingMdl = new UsingModel();
		$usingMdl->deleteConnection($_POST['deleteConnectionID'], $_SESSION['userID']);
		header('Location: /Fantastic-Teaching/?/User/profile');
		
	}
}