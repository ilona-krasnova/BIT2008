<?php
    // Ilona Krasnova
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    setcookie("CURR_USER", NULL, time()-3600);
    header("Location: index.php");
    exit();
?>