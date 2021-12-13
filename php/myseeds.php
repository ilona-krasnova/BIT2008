<?php
// Ilona Krasnova
    include('header.php');

    $seedIdToList = getRequestParam('list');
    if ($seedIdToList) 
    {
        exeUpdate($dblink, "INSERT INTO BC_Listing (SeedID) VALUES (".$seedIdToList.")");
    }

    $listingIdToUnlist = getRequestParam('unlist');
    if ($listingIdToUnlist) 
    {
        exeUpdate($dblink, "UPDATE `BC_Listing` SET `Active` = '0' WHERE `BC_Listing`.`ID` = ".$listingIdToUnlist);
    }

    $listingIdToRelist = getRequestParam('relist');
    if ($listingIdToRelist) 
    {
        exeUpdate($dblink, "UPDATE `BC_Listing` SET `Active` = '1' WHERE `BC_Listing`.`ID` = ".$listingIdToRelist);
    }

    $mySeeds = exeSelect($dblink, 
    "SELECT BC_Seed.ID AS SeedID, BC_Seed.SeedName, BC_Seed.Description, BC_Listing.ID AS ListingID, BC_Listing.Active, BC_Listing.Posted
    FROM BC_Seed 
    LEFT OUTER JOIN BC_Listing ON BC_Listing.SeedID = BC_Seed.ID
    WHERE BC_Seed.UserID = " . $currUser
    );
    include('myseeds.html');

?>

<?php
    include('footer.php');
?>
