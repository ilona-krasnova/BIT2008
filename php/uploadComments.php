
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
	include_once "../../secure/db_open.php";
	include "lib.php"; // IK

	//Selecting comments table from database
	$commentTbl = "BC_SeedComment";
	$cCom = (isset($_REQUEST['uCom'])) ? $_REQUEST['uCom'] : "N/A";
	$seedId = getRequestParam('seedId'); // IK
	$userId = getRequestParam('userId');// IK

	//Query to insert comment info into database table
	// $commentQuery = "INSERT INTO $commentTbl (Timestamp, Comment) VALUES (NOW(), '$cCom')";
	$commentQuery = "INSERT INTO $commentTbl (SeedID, UserID, Comment) VALUES ($seedId, $userId, '$cCom')"; //IK
	$resultInsert = mysqli_query($dblink, $commentQuery);

	//Check to ensure correct values are going into database
	echo "Result insert is " . $resultInsert;
	if($resultInsert == false) {
		echo mysqli_error($dblink);
	}
	else {

	}

	include_once "../../secure/db_close.php" ;
	?>
	</html>
