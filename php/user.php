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
      echo "<div class='ui tabular menu'>
          <div class='item active'>Seeds you have listed</div></div>";
       echo "<table class='ui compact celled table'>";
       echo "<thead>
         <tr>
           <th class='three wide'>Seed Name</th>
           <th>Description</th>
           <th>Quantity</th>
           <th>Plant Type ID</th>
           <th>Life Cycle ID</th>
           <th>Sun ID</th>
          <th>Maintenance ID</th>
         </tr>
       </thead>";
       echo "<td>";
       echo $z['SeedName'] .  "</td>"  . "<td>" . $z['Description'] . "</td>"  .  "<td>"  .  $z['Quantity']  .  "</td>" . "<td>"  .  $z['PlantTypeID'] .  "</td>"  .  "<td>"  .   $z['LifeCycleID']   .   "</td>"  .  "<td>"  .  $z['SunID']  .  "</td>"  .  "<td>"  .  $z['MaintenanceID']  .  "</tr>";
       //echo "</td>";
       echo "</table>";
     }

      //  echo $z['SeedName'] . "  |  " . $z['Description'] . "  |  " . $z['Quantity'] .  "  |  " . $z['PlantTypeID'] .   "  |  "  .   $z['LifeCycleID']   .   "  |  " .   $z['SunID'] . "   |   " .  $z['MaintenanceID']  . "<br>";


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
