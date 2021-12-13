<?php
    include('header.php');

    $exchangeId = getRequestParam('id');
    $message = getRequestParam('message');

    // if a new chat message is being saved...
    if ($message) 
    {
        $sql = "INSERT INTO BC_ExchangeChat (`ExchangeID`, `UserID`, `Message`)
        VALUES ($exchangeId, $currUser, '$message')";
        exeUpdate($dblink, $sql);
    }

    $exchange = exeSelectOne($dblink,
        "SELECT BC_Request.ListingID, BC_Exchange.ListingIDtoBarter
        FROM BC_Exchange
        INNER JOIN BC_Request ON BC_Request.ID = BC_Exchange.RequestID
        WHERE BC_Exchange.ID =".$exchangeId
    );
    // echo "listings " . $exchange['ListingID'] . " <-> ". $exchange['ListingIDtoBarter'] . "<br>";

    $listings = exeSelect($dblink,
        "SELECT SeedID, BC_Seed.UserID, Username, Address, PostalCode, SeedName, Description
        FROM BC_Listing
        INNER JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID
        INNER JOIN BC_User ON BC_User.ID = BC_Seed.UserID
        INNER JOIN BC_UserAddress ON BC_UserAddress.UserID = BC_User.ID
        WHERE BC_Listing.ID = ".$exchange['ListingID']." OR BC_Listing.ID = ".$exchange['ListingIDtoBarter']
    );

    if ($currUser == $listings[0]['UserID'])
    {
        $sending = $listings[0];
        $receiving = $listings[1];
    }
    else
    {
        $sending = $listings[1];
        $receiving = $listings[0];
    }

    // echo "sending " . implode($sending, " | ") . "<br>";
    // echo "receiving " . implode($receiving, " | ") . "<br>";


    $chat = exeSelect($dblink,
    "SELECT BC_User.Username, BC_ExchangeChat.UserID, BC_ExchangeChat.Timestamp, BC_ExchangeChat.Message, BC_ExchangeChat.ExchangeID 
    FROM BC_ExchangeChat 
    INNER JOIN BC_User ON BC_User.ID = BC_ExchangeChat.UserID 
    WHERE BC_ExchangeChat.ExchangeID = ". $exchangeId."
    ORDER BY BC_ExchangeChat.Timestamp ASC"
    );

    include('exchange.html');


    // //Get RequestID and ListingIDtoBarter from BC_Exchange table
    // $getID = getRequestParam('id');
    // $queryExchange = "SELECT RequestID, ListingIDtoBarter FROM BC_Exchange WHERE ID =" . $getID;
    // $exchangeTableResult = mysqli_query($dblink, $queryExchange);


    // //Declare variables to hold values of RequestID and ListingIDtoBarter
    // $requestedSeed;
    // $receiverSeed;


    // //Initialize variables requester and receiver
    // foreach ($exchangeTableResult as $seedRecord)
    // {
    //    $requestedSeed = $seedRecord['RequestID'];
    //    $receiverSeed = $seedRecord['ListingIDtoBarter'];
    // }



    // //Declare UserID's to swap
    // $requesterUserID;
    // $receiverUserID;


    // //Get requester ID
    // $findRequester = "SELECT UserID FROM BC_Seed WHERE ID =" . $requestedSeed;
    // $findRequesterResult = mysqli_query($dblink, $findRequester);


    // foreach ($findRequesterResult as $userID)
    // {
    //   $requesterUserID = $userID['UserID'];
    // }


    // //Get receiver ID
    // $findReceiver = "SELECT UserID FROM BC_Seed WHERE ID =" . $receiverSeed;
    // $findReceiverResult = mysqli_query($dblink, $findReceiver);


    // foreach ($findReceiverResult as $userID)
    // {
    //   $receiverUserID = $userID['UserID'];
    // }


    // //Swap requester and receiver userID's
    // $swapUser = "UPDATE BC_Seed SET UserID = " .  $requesterUserID .  " WHERE ID = " . $receiverSeed;
    // $swapResult = mysqli_query($dblink, $swapUser);


    // $swapUser = "UPDATE BC_Seed SET UserID = " .  $receiverUserID .  " WHERE ID = " . $requestedSeed;
    // $swapResult = mysqli_query($dblink, $swapUser);


    // //Update completed column in BC_Exchange
    // $updateExchange = "UPDATE BC_Exchange SET Complete = 1 WHERE ID = " . $getID;
    // $update = mysqli_query($dblink, $updateExchange);

// ?>

<?php
    include('footer.php');
?>

<?php
//BACKUP

/*
//User 4's seed is now user 3's seed
$seedSwap = "UPDATE BC_Seed SET UserID = 4 WHERE ID = 3 AND UserID = 3";

$resQuery = mysqli_query($dblink, $seedSwap);

if (!$resQuery)
{
    echo "<p>" . mysqli_error($dblink) . "</p>";
}

//User 3's seed is now user 4's seed
$seedSwap = "UPDATE BC_Seed SET UserID = 3 WHERE ID = 4 AND UserID = 4";

$resQuery = mysqli_query($dblink, $seedSwap);

if (!$resQuery)
{
  echo "<p>" . mysqli_error($dblink) . "</p>";
}

//Testing that the previous code ran
echo "success!";
*/
 ?>
