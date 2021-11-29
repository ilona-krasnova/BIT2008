<?php

    include('header.php');


    //Printing off first requested seed name
    $userRequestSeed = "SELECT BC_Seed.SeedName, BC_User.ID, BC_Request.Requested
    FROM (BC_User INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID)
    INNER JOIN BC_Request ON BC_User.ID = BC_Request.UserID";
    $query = mysqli_query($dblink, $userRequestSeed);
    $numRows = mysqli_num_rows($query);
    if($numRows > 0) {
      while ($rowData = mysqli_fetch_assoc ($query)) {
        break;
      }
    }



    include('exchangelist.html');
    include('footer.php');
?>
