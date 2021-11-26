<?php

    include('header.php');

    // $id = REQUEST
    // $seed
    // select <all seed details> using inner join
        $seed = "SELECT
        BC_Seed.SeedName,
        BC_Seed.Quantity,
        BC_Seed.Description,
        BC_Zone.Description,
        BC_LifeCycle.LifeCycle,
        BC_Maintenance.Maintenance,
        BC_PlantType.PlantType,
        BC_Sun.Sun
          FROM
              BC_Sun
          INNER JOIN(
                  BC_PlantType
              INNER JOIN(
                      BC_Maintenance
                  INNER JOIN(
                          BC_LifeCycle
                      INNER JOIN(
                              BC_Zone
                          INNER JOIN(
                                  BC_Seed
                              INNER JOIN BC_SeedZone ON BC_Seed.ID = BC_SeedZone.SeedID
                              )
                          ON
                              BC_Zone.ID = BC_SeedZone.ZoneID
                          )
                      ON
                          BC_LifeCycle.ID = BC_Seed.LifeCycleID
                      )
                  ON
                      BC_Maintenance.ID = BC_Seed.MaintenanceID
                  )
              ON
                  BC_PlantType.ID = BC_Seed.PlantTypeID
              )
          ON
              BC_Sun.ID = BC_Seed.SunID WHERE SeedName LIKE 'Rainbow blend carrots'";

        $resQuery = mysqli_query($dblink, $seed);
        $numRows = mysqli_num_rows($resQuery);
          if($numRows > 0) {
            while($rowData = mysqli_fetch_assoc($resQuery)) {
              break;
          }
      }

      //$seedComments
          $seedComments = exeSelect($dblink, "SELECT BC_User.Username, BC_SeedComment.Timestamp, BC_SeedComment.Comment
          FROM BC_User INNER JOIN BC_SeedComment ON BC_User.ID = BC_SeedComment.UserID");

      //debug

      //Printing off Username, Timestamp and Comment
      foreach ($seedComments as $row) {
          echo implode(" | ", $row) . "<br>";
      }


    include('seed.html');
    include('footer.php');

?>
