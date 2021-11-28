<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
    }
    include('exchange.html');

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


?>

<?php
    include('footer.php');
?>
