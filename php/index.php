<?php
    // Ilona Krasnova
    include('header.php');

    // $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    // foreach ($users as $user) {
    //    echo $user['Username'] . "<br>";
    //  }    
 $featured = exeSelect($dblink, 
    "SELECT BC_Listing.ID AS ListingID, BC_Seed.UserID, BC_Listing.SeedID, BC_Seed.SeedName, BC_Listing.Posted, 
    (SELECT count(*) FROM BC_SeedComment 
    WHERE SeedID=BC_Seed.ID) AS CommentCount FROM BC_Listing 
    JOIN BC_Seed ON BC_Seed.ID = BC_Listing.SeedID 
    WHERE BC_Listing.Active= 1 
    ORDER BY CommentCount DESC"
 );

    include('home.html');


    include('footer.php');
?>