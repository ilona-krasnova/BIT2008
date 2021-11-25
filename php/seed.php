<?php
    include('header.php');

    // $id = REQUEST
    // $seed
    // $seedComments
    // select <all seed details>


    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
     }
    include('seed.html');
?>

<?php
    include('footer.php');
?>