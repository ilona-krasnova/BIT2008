<?php
    include('header.php');

    $users = exeSelect($dblink, "SELECT ID, Username, Email, PasswordHash FROM BC_User");
    foreach ($users as $user) {
       echo $user['Username'] . "<br>";
     }
    include('signup.html');
?>

<?php
    include('footer.php');
?>