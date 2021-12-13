<?php

    include('header.php');
    // include_once('comment.php');

    // this is actually a "Seed with a listing", but we're in too deep to change the file names now.
    $listingId = getRequestParam('id');

    //seed info query
        $seed = "SELECT
              BC_Listing.SeedID,
              BC_Seed.Quantity,
              BC_PlantType.PlantType,
              BC_LifeCycle.LifeCycle,
              BC_Maintenance.Maintenance,
              BC_Seed.SeedName,
              BC_Sun.Sun
                FROM
                    BC_Sun
                INNER JOIN(
                        BC_Maintenance
                    INNER JOIN(
                            BC_LifeCycle
                        INNER JOIN(
                                BC_PlantType
                            INNER JOIN BC_Seed ON BC_PlantType.ID = BC_Seed.PlantTypeID
                            )
                        ON
                            BC_LifeCycle.ID = BC_Seed.LifeCycleID
                        )
                    ON
                        BC_Maintenance.ID = BC_Seed.MaintenanceID
                    )
                ON
                BC_Sun.ID = BC_Seed.SunID
                INNER JOIN BC_Listing ON BC_Listing.SeedID = BC_Seed.ID
                WHERE BC_Listing.ID = " . $listingId;
          $resQuery = mysqli_query($dblink, $seed);
          $numRows = mysqli_num_rows($resQuery);
            if($numRows > 0) {
              while($rowData = mysqli_fetch_assoc($resQuery)) {
                break;
            }
        }

      $seedId = $rowData['SeedID']; // set variable for comment.php to use -- IK
      include_once('comment.php'); // IK

      //seed description query
      $description = "SELECT
        BC_Seed.Description,
        BC_Seed.SeedName,
        BC_Seed.UserID,
        BC_User.Username
          FROM BC_Seed
            INNER JOIN BC_Listing ON BC_Listing.SeedID = BC_Seed.ID
            INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
          WHERE BC_Listing.ID = " . $listingId;
      $dquery = mysqli_query($dblink, $description);
      $numRows = mysqli_num_rows($dquery);
      if($numRows > 0) {
        while($rows = mysqli_fetch_assoc($dquery)) {
          break;
        }
      }

    //seed zone query
    $seedZone = exeSelect($dblink, "SELECT
      BC_Zone.ID,
      BC_Zone.Description
        FROM BC_Zone
          INNER JOIN BC_SeedZone
            ON BC_SeedZone.ZoneID = BC_Zone.ID
        WHERE BC_SeedZone.SeedID = ". $rowData['SeedID']);

    /*comment info query option 2
    $comment = "SELECT
      BC_User.Username,
      BC_SeedComment.Timestamp,
      BC_SeedComment.Comment,
      BC_SeedComment.SeedID
        FROM BC_User
          INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID
        WHERE BC_SeedComment.SeedID = " . $seedId;*/

    //username query
    $username = "SELECT Username FROM BC_User";
    $namequery = mysqli_query($dblink, $username);
    $numRows = mysqli_num_rows($namequery);
    if($numRows > 0) {
      while ($row = mysqli_fetch_assoc($namequery)){
        break;
      }
    }


    // Ran out of time; was about to write logic for request button -- IK
  //   $alreadyRequested = exeSelectOne($dblink, 
  //   "SELECT Rejected, Complete FROM BC_Listing 
  //   LEFT OUTER JOIN BC_Request ON BC_Request.ListingID = BC_Listing.ID 
  //   LEFT OUTER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID 
  //   WHERE BC_Listing.ID = ".$listingId." AND UserID = ". $currUser
  // );

  // $rejected = $alreadyRequested['Rejected'];
  // $complete = $alreadyRequested['Complete'];

  // if (($rejected != 0)) {
  //   # code...
  // }

  include('seed.html');
  include('footer.php');

?>

</html>
