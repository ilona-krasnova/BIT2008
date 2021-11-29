<?php
    include('header.php');

    $maintenance = getRequestParam('maintenance');

    $maintenanceList = exeSelect($dblink, "SELECT ID, Maintenance FROM BC_Maintenance");

    // listing id, user id, seed id, seed name, date listed, quantity of comments
    $sql = "SELECT BC_Listing.ID AS ListingID, BC_Seed.UserID, BC_Listing.SeedID, BC_Seed.SeedName, BC_Listing.Posted,"
        . " (SELECT count(*) FROM BC_SeedComment WHERE SeedID=BC_Seed.ID) AS CommentCount"
        . " FROM BC_Listing JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID"
        . " WHERE BC_Listing.Active=1";
    if ($maintenance) { 
        $sql = $sql . " AND BC_Seed.MaintenanceID = " . $maintenance; 
    }
    $listings = exeSelect($dblink, $sql);

    // debug
    foreach ($maintenanceList as $row) {
        echo implode(" | ", $row) . "<br>";
    }
    foreach ($listings as $row) {
        echo implode(" | ", $row) . "<br>";
    }
    include('catalogue.html');
    include('footer.php');
?>