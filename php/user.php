<?php
    include('header.php');

    $userId = getRequestParam('id'); //IK

    $user = exeSelectOne($dblink, "SELECT `ID`, `Username`,`Bio` FROM `BC_User` WHERE ID = ". $userId); //IK

    $userListings = exeSelect($dblink, 
    "SELECT BC_Listing.ID AS ListingID, BC_Seed.UserID, BC_Listing.SeedID, BC_Seed.SeedName, BC_Listing.Posted, 
    (SELECT count(*) FROM BC_SeedComment 
    WHERE SeedID=BC_Seed.ID) AS CommentCount FROM BC_Listing 
    JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID 
    WHERE BC_Listing.Active= 1 
    AND BC_Seed.UserID = " . $userId
    );
    include('user.html');



    // $seedSelectSQL = "SELECT SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID FROM BC_Seed WHERE UserID ="  .  $currUser;
    // $seedSelectResult = mysqli_query($dblink, $seedSelectSQL);

    // foreach ($seedSelectResult as $z) {
    //   echo "<div class='ui tabular menu'>
    //       <div class='item active'>Seeds you have listed</div></div>";
    //    echo "<table class='ui compact celled table'>";
    //    echo "<thead>
    //      <tr>
    //        <th class='three wide'>Seed Name</th>
    //        <th>Description</th>
    //        <th>Quantity</th>
    //        <th>Plant Type ID</th>
    //        <th>Life Cycle ID</th>
    //        <th>Sun ID</th>
    //       <th>Maintenance ID</th>
    //      </tr>
    //    </thead>";
    //    echo "<td>";
    //    echo $z['SeedName'] .  "</td>"  . "<td>" . $z['Description'] . "</td>"  .  "<td>"  .  $z['Quantity']  .  "</td>" . "<td>"  .  $z['PlantTypeID'] .  "</td>"  .  "<td>"  .   $z['LifeCycleID']   .   "</td>"  .  "<td>"  .  $z['SunID']  .  "</td>"  .  "<td>"  .  $z['MaintenanceID']  .  "</tr>";
    //    //echo "</td>";
    //    echo "</table>";
    //  }

?>

<?php
    include('footer.php');
?>
