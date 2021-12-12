<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
     }
    include('user.html');

    //Query the seeds for the user

    //ORIGINAL
    //$seedSelect = "SELECT * FROM BC_Seed";

    $seedSelectSQL = "SELECT SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID FROM BC_Seed WHERE UserID ="  .  $currUser;
    $seedSelectResult = mysqli_query($dblink, $seedSelectSQL);


    foreach ($seedSelectResult as $z) {
       echo $z['SeedName'] . "  |  " . $z['Description'] . "  |  " . $z['Quantity'] .  "  |  " . $z['PlantTypeID'] .   "  |  "  .   $z['LifeCycleID']   .   "  |  " .   $z['SunID'] . "   |   " .  $z['MaintenanceID']  . "<br>";
     }




/*
    $resQuery = mysqli_query($dblink, $seedSelectSQL);

    if (!$resQuery)
    {
        echo "<p>" . mysqli_error($dblink) . "</p>";
    }


    echo "<table border = '1'>";
    echo "<tr><td>SeedName</td><td>Description</td><td>Quantity</td><td>PlantTypeID</td><td>LifeCycleID</td><td>SunID</td><td>MaintenanceID</td></tr>";
    while($rowData = mysqli_fetch_assoc($resQuery))
    {
      echo "<tr><td>{$rowData['SeedName']}</td><td>{$rowData['Description']}</td><td>{$rowData['Quantity']}</td><td>{$rowData['PlantTypeID']}</td><td>{$rowData['LifeCycleID']}</td><td>{$rowData['SunID']}</td><td>{$rowData['MaintenanceID']}</td></tr>";
    }
    echo "</table>";
*/

?>

<?php
    include('footer.php');
?>
