<?php

    include('header.php');

      //Received table: requested from current user, however not yet bartered for.
        $receivedResult = mysqli_query($dblink, 
        "SELECT BC_Request.ID, BC_Seed.UserID, BC_User.Username, BC_Listing.SeedID, BC_Seed.SeedName, Requested
        FROM BC_Request
        INNER JOIN BC_Listing ON BC_Listing.ID = BC_Request.ListingID
        INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
        INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
        LEFT OUTER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID
        WHERE BC_Seed.UserID = " . $currUser . "
        AND Rejected = 0 
        AND BC_Exchange.ID IS NULL"
      ); // IK 
      
      // TODO: Would be nice to include logic prohibiting creating requests for items currently in exchange
      //  and automatically rejecting other requests when one is accepted as an exchange. -- IK

      // $receivedResult = mysqli_query($dblink,"SELECT
        //           BC_User.Username,
        //           BC_Seed.SeedName,
        //           BC_Request.Requested
        //           FROM (BC_User
        //             INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
        //           INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID");

     //Active table : current, ongoing exchanges

     $activeResult1 = mysqli_query($dblink,
     "SELECT BC_Exchange.ID, BC_Exchange.Accepted,
     BC_Listing.SeedID AS sSeedID, BC_Seed.UserID AS currUserID, BC_User.Username AS currUsername, BC_Seed.SeedName AS sSeedName, 
     BarterListing.SeedID AS rSeedID, BarterSeed.UserID AS bUserID, BarterUser.Username as bUsername, BarterSeed.SeedName as rSeedName
           FROM BC_Listing
           INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
           INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
           INNER JOIN BC_Request ON BC_Request.ListingID = BC_Listing.ID
           INNER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID
           INNER JOIN BC_Listing AS BarterListing ON BarterListing.ID = BC_Exchange.ListingIDtoBarter
           INNER JOIN BC_Seed AS BarterSeed ON BarterSeed.ID = BarterListing.SeedID
           INNER JOIN BC_User AS BarterUser ON BarterUser.ID = BarterSeed.UserID
           WHERE BC_Seed.UserID = ". $currUser
           ); // IK

    $activeResult2 = mysqli_query($dblink,
      "SELECT BC_Exchange.ID, BC_Exchange.Accepted,
      BC_Listing.SeedID AS rSeedID, BC_Seed.UserID AS bUserID, BC_User.Username AS bUsername, BC_Seed.SeedName AS rSeedName, 
      BarterListing.SeedID AS sSeedID, BarterSeed.UserID AS currUserID, BarterUser.Username as currUsername, BarterSeed.SeedName as sSeedName
      FROM BC_Listing
      INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
      INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
      INNER JOIN BC_Request ON BC_Request.ListingID = BC_Listing.ID
      INNER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID
      INNER JOIN BC_Listing AS BarterListing ON BarterListing.ID = BC_Exchange.ListingIDtoBarter
      INNER JOIN BC_Seed AS BarterSeed ON BarterSeed.ID = BarterListing.SeedID
      INNER JOIN BC_User AS BarterUser ON BarterUser.ID = BarterSeed.UserID
      WHERE BarterSeed.UserID = ". $currUser
      ); // IK


        // $activeResult = mysqli_query($dblink,"SELECT
        //           BC_User.Username,
        //           BC_Seed.SeedName,
        //           BC_Request.Requested,
        //           BC_Exchange.ID
        //           FROM((BC_User
        //               INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
        //               INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID)
        //           INNER JOIN BC_Exchange ON BC_Request.ID = BC_Exchange.RequestID");

      //Sent table : requested by current user, but not yet bartered
        $sentResult = mysqli_query($dblink, 
          "SELECT BC_Request.ID, BC_Seed.UserID, BC_User.Username, BC_Listing.SeedID, BC_Seed.SeedName, Requested
          FROM BC_Request
          INNER JOIN BC_Listing ON BC_Listing.ID = BC_Request.ListingID
          INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
          INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
          LEFT OUTER JOIN BC_Exchange ON BC_Exchange.RequestID = BC_Request.ID
          WHERE BC_Request.UserID = " . $currUser . "
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
