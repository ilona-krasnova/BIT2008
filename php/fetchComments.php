<?php
	include_once "../../secure/db_open.php";
	include('lib.php');

	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	$seedId = getRequestParam('id');

	//Creating comment query to pull needed info for comments based on seedID
	$comment = "SELECT
		BC_User.Username,
		BC_SeedComment.CommentTimestamp,
		BC_SeedComment.Comment,
		BC_SeedComment.SeedID
			FROM BC_User
				INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID
			WHERE BC_SeedComment.SeedID = '1' ORDER BY BC_SeedComment.CommentTimestamp ASC";  // " . $seedId;
	$commentQuery = mysqli_query($dblink, $comment);

	//Error message or success
	if($commentQuery == false) {
		echo mysqli_error($dblink);
	}
	else {
		$rows = mysqli_fetch_assoc($commentQuery);
		$numRows = mysqli_num_rows($commentQuery);

		//Printing off comments from database
		while($rows) {
			 echo "<b> {$rows['Username']} </b>";
			 echo $rows['CommentTimestamp'], "</br>";
			 echo $rows['Comment'], "<br>";
			 $rows = mysqli_fetch_assoc($commentQuery);
		}
	}

	include_once "../../secure/db_close.php";
?>
