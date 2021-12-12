<?php
    include('header.php');

    $exchangeId = getRequestParam('id');

    $exchange = exeSelectOne($dblink, 
        "SELECT BC_Request.ListingID, BC_Exchange.ListingIDtoBarter
        FROM BC_Exchange
        INNER JOIN BC_Request ON BC_Request.ID = BC_Exchange.RequestID
        WHERE BC_Exchange.ID =".$exchangeId
    );
    echo "listings " . $exchange['ListingID'] . " <-> ". $exchange['ListingIDtoBarter'] . "<br>";

    $listings = exeSelect($dblink, 
        "SELECT SeedID, BC_Seed.UserID, Username, Address, SeedName, Description
        FROM BC_Listing
        INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
        INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
        INNER JOIN BC_UserAddress ON BC_UserAddress.UserID = BC_User.ID
        WHERE BC_Listing.ID = ".$exchange['ListingID']." OR BC_Listing.ID = ".$exchange['ListingIDtoBarter']
    );

    foreach ($listings as $listing) {
       echo implode($listing, " | ") . "<br>";
    } 
    include('exchange.html');

    // //User 4's seed is now user 3's seed
    // $seedSwap = "UPDATE BC_Seed SET UserID = 4 WHERE ID = 3 AND UserID = 3";

    // $resQuery = mysqli_query($dblink, $seedSwap);

    // if (!$resQuery)
    // {
    //     echo "<p>" . mysqli_error($dblink) . "</p>";
    // }

    // //User 3's seed is now user 4's seed
    // $seedSwap = "UPDATE BC_Seed SET UserID = 3 WHERE ID = 4 AND UserID = 4";

    // $resQuery = mysqli_query($dblink, $seedSwap);

    // if (!$resQuery)
    // {
    //   echo "<p>" . mysqli_error($dblink) . "</p>";
    // }

    // //Testing that the previous code ran
    // echo "success!";


?>

<?php
    include('footer.php');
?>
