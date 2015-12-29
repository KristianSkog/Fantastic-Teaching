<?php
setlocale(LC_ALL, 'sv_SE.UTF-8', 'sve'); 
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>show search result</title>
</head>
<body>



	<div class="containerAllPostsNoFloat">

		<!-- SHOW RESULT --> 
		<?php
		
		$mysqli = new mysqli("localhost", "root", "root", "fantastic_teaching");

		if($mysqli->connect_errno) {
			echo "Could not connect to database.<br />" . $mysqli->connect_error;
			exit();

		// if user clicks search without a search string
		} else if(!isset($_POST['search']) || trim($_POST['search']) == '') {
			echo "<div class='alerts'>" . "You did not enter a search string. Go back and try again." . "</div>";
			adBack();
			exit();

		// select and show results
		} else {
			$stmt = $mysqli->stmt_init();
			$searchString = $_POST["search"];
			$query = "	SELECT content_id, title, text
						FROM content
						WHERE title LIKE '%" . $searchString . "%'
						OR text LIKE '%" . $searchString . "%'";
	 
			if($stmt->prepare($query)) {
				$stmt->execute();
				$stmt->bind_result($content_id, $title, $text);
				// loop result
				while(mysqli_stmt_fetch($stmt)) {
					echo "<h2>" . $title . "</h2>" . "<p>" . substr($text, 0, 150) . "...</p>";
					echo "<a href='showpost.php?postid=" . $content_id . "'>Read whole post</a>";
					
				// if number of result rows is 0, show no result
				} if($stmt->num_rows == 0) {
					echo "<div class='alerts'> Sorry. No search results! </div>";
					adBack();
					exit();
				}
			}
			adBack();
			// $stmt->close();                ????????????????????????SKA DENNA VARA KOMMENTERAD???????????????????????????????
		}
		$mysqli->close();

		?>
		<!-- end SHOW RESULT --> 
		<?php function adBack() { ?>

		<!-- GO BACK -->
		<br /><br />
		<form method="post" action="index.php">
			<input class="search" type="submit" value="GO BACK">
		</form>
		<!-- end GO BACK -->

		<?php } ?>

	</div>
</body>
</html>