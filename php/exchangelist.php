<?php

    include('header.php');

    //SQL to get Username and SeedName from database
    $name = exeSelect($dblink, "SELECT BC_User.Username, BC_Seed.SeedName
      FROM BC_User INNER JOIN BC_Seed ON BC_User.ID = BC_Seed.UserID");

    //SQL to get Exchange ID and Requested from database
    $info = exeSelect($dblink, "SELECT BC_Exchange.ID, BC_Request.Requested
      FROM BC_Seed, BC_Request INNER JOIN BC_Exchange ON BC_Request.ID = BC_Exchange.RequestID");

    // debugging

    //Printing off Username and Seedname
    foreach ($name as $row) {
          echo implode(" | ", $row) . "<br>";
    }

    //Printing off ID and Requested
    foreach ($info as $rowData) {
          echo implode(" | ", $rowData) . "<br>";
    }


    include('exchangelist.html');
    include('footer.php');
?>
