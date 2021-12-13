<?php
    include('header.php');

  //  $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
  //  foreach ($users as $user) {
  //     echo $user['Username'] . "<br>";
  //   }

    $seed = getRequestParam('SeedName');
    $amount = getRequestParam('quantity');
    $type = getRequestParam('type');
    $cycle = getRequestParam('lifeCycle');
    $sunReq = getRequestParam('sunRequirements');
    $maint = getRequestParam('maintenance');
    $desc = getRequestParam('description');

    if ($seed) // IK
    {
      $createNewSeedSQL = "INSERT INTO BC_Seed (UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES (" . $currUser .  ",'"  .   $seed  .  "','"  .  $desc   .   "',"   .   $amount   .    ","   .    $type   .   ","    .   $cycle   .   ","   .   $sunReq   .   ","   .   $maint  .  ")";
      $resQuery = mysqli_query($dblink, $createNewSeedSQL);
      if ($resQuery) 
      {
        header("Location: myseeds.php");
      }
      else
      {
        echo(mysqli_error($dblink));
      }
    }

    include('newseed.html');


?>

<?php
    include('footer.php');
?>
