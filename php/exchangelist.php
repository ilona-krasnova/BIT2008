<?php

    include('header.php');

      //Received table: requested from current user, however not yet bartered for.
        $receivedResult = mysqli_query($dblink,"SELECT
                  BC_User.Username,
                  BC_Seed.SeedName,
                  BC_Request.Requested
                  FROM (BC_User
                    INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                  INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID");

     //Active table : current, ongoing exchanges
        $activeResult = mysqli_query($dblink,"SELECT
                  BC_User.Username,
                  BC_Seed.SeedName,
                  BC_Request.Requested,
                  BC_Exchange.ID
                  FROM((BC_User
                      INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
                      INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID)
                  INNER JOIN BC_Exchange ON BC_Request.ID = BC_Exchange.RequestID");

      //Sent table : requested by current user, but not yet bartered
        $sentResult = mysqli_query($dblink, 
          "SELECT BC_Request.ID, BC_Seed.UserID, BC_User.Username, BC_Listing.SeedID, BC_Seed.SeedName, Requested
          FROM BC_Request
          INNER JOIN BC_Listing ON BC_Listing.ID = BC_Request.ListingID
          INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
          INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
          LEFT OUTER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID
          WHERE BC_Request.UserID = 1 
          AND Rejected = 0 
          AND BC_Exchange.ID IS NULL"
        ); // IK

        // $sentResult = mysqli_query($dblink,"SELECT
        //             BC_User.Username,
        //             BC_Seed.SeedName,
        //             BC_Request.Requested
        //             FROM(BC_User
        //               INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
        //             INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID");

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
