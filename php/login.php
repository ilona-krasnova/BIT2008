<?php
    // Ilona Krasnova
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    include_once "../../secure/db_open.php";
    include('lib.php');

    $email=getRequestParam('email');
    $password=getRequestParam('password');
    $message = NULL;
    if ($email && $password) 
    {
        $users = exeSelect($dblink, "SELECT ID, Username FROM BC_User 
        WHERE Email = '" . $email . "' AND PasswordHash = '" . $password ."'");
        // TODO: Use real hash instead of clear text
        if (count($users) > 0)
        {
            // successful login
            $userId = $users[0]['ID'];
            echo $userId;
            setcookie("CURR_USER", $userId, time()+3600);
            header("Location: index.php");
            exit();
        }
        $message = "Incorrect username or password.";
    } // end if email && password

    include('login.html');

    include_once "../../secure/db_close.php";
?>