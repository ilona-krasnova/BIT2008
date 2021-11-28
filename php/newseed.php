<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
     }
    include('newseed.html');

    //In part 4, will get user input instead of hard coded values to be added to table
    //$createNewSeed = "INSERT INTO BC_Seed (ID, UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES ('3', '3', 'Sunflower Seeds', 'Yellow petals, brown centre. Grows very big.', '5', '3', '1', '1', '1')";
    //$resQuery = mysqli_query($dblink, $createNewSeed);

    $createNewSeed = "INSERT INTO BC_Seed (ID, UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES ('4', '4', 'Pumpkin Seeds', 'Medium to large orange squash.', '4', '2', '1', '1', '2')";
    $resQuery = mysqli_query($dblink, $createNewSeed);

  

    //Testing that the previous code ran
    echo "Hello world";


?>

<?php
    include('footer.php');
?>
