<?php

    include('header.php');
    // include_once('comment.php');

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
        BC_Seed.SeedName
          FROM BC_Seed
            INNER JOIN BC_Listing ON BC_Listing.SeedID = BC_Seed.ID
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

  include('seed.html');
  include('footer.php');

?>

</html>
