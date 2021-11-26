<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
     }
    include('newseed.html');

    //Missing ID, UserID, PlantTypeID, LifeCycleID, SunID, MaintenanceID
    //$createNewSeed = "INSERT INTO BC_Seed (ID, UserID, SeedName, Description, Quantity, PlantTypeID, LifeCycleID, SunID, MaintenanceID) VALUES ('3', '3', 'Sunflower Seeds', 'Yellow petals, brown centre. Grows very big.', '5', '3', '1', '1', '1')";
    //$resQuery = mysqli_query($dblink, $createNewSeed);
    //echo "hello world";

?>

<?php
    include('footer.php');
?>
