<?php

    include('header.php');

    $listingId = getRequestParam('id'); // IK

    //Printing off seed details using inner join
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
                WHERE BC_Listing.ID = " . $listingId; // SeedName LIKE 'Rainbow blend carrots'"; // IK
          $resQuery = mysqli_query($dblink, $seed);
          $numRows = mysqli_num_rows($resQuery);
            if($numRows > 0) {
              while($rowData = mysqli_fetch_assoc($resQuery)) {
                break;
            }
        }

      //Printing off seedDescription
      $description = "SELECT BC_Seed.Description, BC_Seed.SeedName FROM BC_Seed 
        INNER JOIN BC_Listing ON BC_Listing.SeedID = BC_Seed.ID
        WHERE BC_Listing.ID = " . $listingId; // WHERE SeedName LIKE'Rainbow blend carrots'"; // IK
      $dquery = mysqli_query($dblink, $description);
      $numRows = mysqli_num_rows($dquery);
      if($numRows > 0) {
        while($rowz = mysqli_fetch_assoc($dquery)) {
          break;
        }
      }

      //Printing off User Comments
      $comment = "SELECT BC_User.Username, BC_SeedComment.Timestamp, BC_SeedComment.Comment
      FROM BC_User INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID";

      // TODO: add condition on seedID to display comments for a given listing only
      // (similar to lines 45-46)
      $cquery = mysqli_query($dblink, $comment);
      $rowsDataArray = array(); // IK
      $numRows = mysqli_num_rows($cquery);
      if($numRows > 0) {
        while ($rowsData = mysqli_fetch_assoc ($cquery)) {
          // break;
          array_push($rowsDataArray, $rowsData); // IK;
        }
      }

      /*//Debug

      //$seedComments
          $seedComments = exeSelect($dblink, "SELECT BC_User.Username, BC_SeedComment.Timestamp, BC_SeedComment.Comment
          FROM BC_User INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID");

      //Printing off Username, Timestamp and Comment
      foreach ($seedComments as $row) {
          echo implode(" | ", $row) . "<br>";
      } */


    include('seed.html');
    include('footer.php');

?>
