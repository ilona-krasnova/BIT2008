<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
    }
    include('exchange.html');


    //Get RequestID and ListingIDtoBarter from BC_Exchange table
    $getID = getRequestParam('id');
    $queryExchange = "SELECT RequestID, ListingIDtoBarter FROM BC_Exchange WHERE ID =" . $getID;
    $exchangeTableResult = mysqli_query($dblink, $queryExchange);


    //Declare variables to hold values of RequestID and ListingIDtoBarter
    $requestedSeed;
    $receiverSeed;


    //Initialize variables requester and receiver
    foreach ($exchangeTableResult as $seedRecord)
    {
       $requestedSeed = $seedRecord['RequestID'];
       $receiverSeed = $seedRecord['ListingIDtoBarter'];
    }


    //DELETE THE FOLLOWING LATER
    echo $requestedSeed;
    echo "<br><br>";
    echo $receiverSeed;
    echo "<br><br>";


    //Declare UserID's to swap
    $requesterUserID;
    $receiverUserID;


    //Get requester ID
    $findRequester = "SELECT UserID FROM BC_Seed WHERE ID =" . $requestedSeed;
    $findRequesterResult = mysqli_query($dblink, $findRequester);


    foreach ($findRequesterResult as $userID)
    {
      $requesterUserID = $userID['UserID'];
    }


    //Get receiver ID
    $findReceiver = "SELECT UserID FROM BC_Seed WHERE ID =" . $receiverSeed;
    $findReceiverResult = mysqli_query($dblink, $findReceiver);


    foreach ($findReceiverResult as $userID)
    {
      $receiverUserID = $userID['UserID'];
    }


    //Swap requester and receiver userID's
    $swapUser = "UPDATE BC_Seed SET UserID = " .  $requesterUserID .  " WHERE ID = " . $receiverSeed;
    $swapResult = mysqli_query($dblink, $swapUser);


    $swapUser = "UPDATE BC_Seed SET UserID = " .  $receiverUserID .  " WHERE ID = " . $requestedSeed;
    $swapResult = mysqli_query($dblink, $swapUser);


    //Update completed column in BC_Exchange
    $updateExchange = "UPDATE BC_Exchange SET Complete = 1 WHERE ID = " . $getID;
    $update = mysqli_query($dblink, $updateExchange);

?>

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
