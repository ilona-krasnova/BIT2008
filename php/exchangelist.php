<?php

    include('header.php');

      //Received table
        $receivedResult = mysqli_query($dblink,"SELECT
                  BC_User.Username,
                  BC_Seed.SeedName,
                  BC_Request.Requested
                  FROM (BC_User
                    INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                  INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID");

     //Active table
        $activeResult = mysqli_query($dblink,"SELECT
                  BC_User.Username,
                  BC_Seed.SeedName,
                  BC_Request.Requested,
                  BC_Exchange.ID
                  FROM((BC_User
                      INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                      INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID)
                  INNER JOIN BC_Exchange ON BC_Request.ID = BC_Exchange.RequestID");

      //Sent table
        $sentResult = mysqli_query($dblink,"SELECT
                    BC_User.Username,
                    BC_Seed.SeedName,
                    BC_Request.Requested
                    FROM(BC_User
                      INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                    INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID");

      //Completed table
      $completedResult = mysqli_query($dblink,"SELECT
                        BC_User.Username,
                        BC_Seed.SeedName,
                        BC_Request.Requested,
                        BC_Exchange.ID
                        FROM((BC_User
                            INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                        INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID)
                    INNER JOIN BC_Exchange ON BC_Request.ID = BC_Exchange.RequestID");


    include('exchangelist.html');
    include('footer.php');
?>
