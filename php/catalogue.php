<?php
    // Ilona Krasnova

    include('header.php');

    $plantType = getRequestParam('plantType');
    $lifeCycle = getRequestParam('lifeCycle');
    $sun = getRequestParam('sun');
    $maintenance = getRequestParam('maintenance');

    $plantTypeList = exeSelect($dblink, "SELECT ID, PlantType FROM BC_PlantType");
    $lifeCycleList = exeSelect($dblink, "SELECT ID, LifeCycle FROM BC_LifeCycle");
    $sunList = exeSelect($dblink, "SELECT ID, Sun FROM BC_Sun");
    $maintenanceList = exeSelect($dblink, "SELECT ID, Maintenance FROM BC_Maintenance");

    // listing id, user id, seed id, seed name, date listed, quantity of comments
    $sql = "SELECT BC_Listing.ID AS ListingID, BC_Seed.UserID, BC_Listing.SeedID, BC_Seed.SeedName, BC_Listing.Posted,"
        . " (SELECT count(*) FROM BC_SeedComment WHERE SeedID=BC_Seed.ID) AS CommentCount"
        . " FROM BC_Listing JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID"
        . " WHERE BC_Listing.Active=1";
    
    if ($plantType) 
    { 
        $sql = $sql . " AND BC_Seed.PlantTypeID = " . $plantType; 
    }
    if ($lifeCycle) 
    { 
        $sql = $sql . " AND BC_Seed.LifeCycleID = " . $lifeCycle; 
    }
    if ($sun) 
    { 
        $sql = $sql . " AND BC_Seed.SunID = " . $sun; 
    } 
    if ($maintenance) 
    { 
        $sql = $sql . " AND BC_Seed.MaintenanceID = " . $maintenance; 
    }
    $listings = exeSelect($dblink, $sql);

    // // debug
    // foreach ($maintenanceList as $row) {
    //     echo implode(" | ", $row) . "<br>";
    // }
    // foreach ($listings as $row) {
    //     echo implode(" | ", $row) . "<br>";
    // }
    include('catalogue.html');
    include('footer.php');
?>