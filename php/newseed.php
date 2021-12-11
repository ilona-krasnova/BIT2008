<?php
    include('header.php');

  //  $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
  //  foreach ($users as $user) {
  //     echo $user['Username'] . "<br>";
  //   }
    include('newseed.html');

    //In part 4, will get user input instead of hard coded values to be added to table
    //$createNewSeed = "INSERT INTO BC_Seed (ID, UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES ('3', '3', 'Sunflower Seeds', 'Yellow petals, brown centre. Grows very big.', '5', '3', '1', '1', '1')";
    //$resQuery = mysqli_query($dblink, $createNewSeed);

    $seed = getRequestParam('SeedName');
    $amount = getRequestParam('quantity');
    $type = getRequestParam('type');
    $cycle = getRequestParam('lifeCycle');
    $sunReq = getRequestParam('sunRequirements');
    $maint = getRequestParam('maintenance');
    $desc = getRequestParam('description');

    $createNewSeedSQL = "INSERT INTO BC_Seed (UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES (" . $currUser .  ",'"  .   $seed  .  "','"  .  $desc   .   "',"   .   $amount   .    ","   .    $type   .   ","    .   $cycle   .   ","   .   $sunReq   .   ","   .   $maint  .  ")";
    $resQuery = mysqli_query($dblink, $createNewSeedSQL);

?>

<?php
    include('footer.php');
?>
