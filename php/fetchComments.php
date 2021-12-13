<?php
	include_once "../../secure/db_open.php";
	include('lib.php');

	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

	$seedId = getRequestParam('seedId');

	//Creating comment query to pull needed info for comments based on seedID
	$comment = "SELECT
		BC_User.Username,
		BC_SeedComment.UserID,
		BC_SeedComment.Timestamp,
		BC_SeedComment.Comment,
		BC_SeedComment.SeedID
			FROM BC_User
				INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID
			WHERE BC_SeedComment.SeedID = " . $seedId . " ORDER BY BC_SeedComment.Timestamp ASC"; // IK
			// WHERE BC_SeedComment.SeedID = '1' ORDER BY BC_SeedComment.Timestamp ASC";

	$commentQuery = mysqli_query($dblink, $comment);

	//Error message or success
	if($commentQuery == false) {
		echo mysqli_error($dblink);
	}
	else {
		$rows = mysqli_fetch_assoc($commentQuery);
		$numRows = mysqli_num_rows($commentQuery);
		if (!$numRows) 
		{
			echo("No comments yet.");
		}
		//Printing off comments from database
		while($rows) {
			//  echo "<b> {$rows['Username']} </b>";
			//  echo $rows['Timestamp'], "</br>";
			//  echo $rows['Comment'], "<br>";
?>	
					<div class="comment">
                      <a class="avatar">
                        <!-- IK: updated the image to reflect the user ID (see img/user/<id>)-->
                        <img src="img/user/<?=$rows['UserID']?>.jpg" style="height: auto;">
                      </a>
                      <div class="content">
                        <a class="author" href="user.php?id=<?=$rows['UserID']?>"><?php echo $rows['Username'] ?></a>
                        <div class="metadata">
                          <div class="date"><?php echo $rows['Timestamp'] ?></div>
                        </div>
                        <div class="text">
                          <?php echo $rows['Comment'] ?>
                        </div>
                      </div>
                    </div>
<?php
			 $rows = mysqli_fetch_assoc($commentQuery);
		}
	}

	include_once "../../secure/db_close.php";
?>
