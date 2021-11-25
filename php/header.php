<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
include_once "../../secure/db_open.php";
include('lib.php');
?>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html">

    <title>Seed + Share | Home</title>
    <meta name="description" content="Exchange you seeds with other local gardeners!" />
    <meta name="keywords" content="seed, exchange, Carleton, BIT@008" />
    <meta name="author" content="Book Club 2: The SQL">

    <link rel="shortcut icon" href="favicon.ico" />

    <!-- libraries -->
    <script src="lib/jquery-3.6.0.min.js"></script>
    <script src="lib/semantic-ui-2.4.1.js"></script>

    <link rel="stylesheet" type="text/css" href="lib/semantic-ui-2.4.0.min.css" />
    <link rel="stylesheet" type="text/css" href="css/override.css" />

    <script>
      $().ready(() => {
        $('.ui.dropdown').dropdown();
        $('.ui.accordion').accordion();
        $('select.dropdown').dropdown();
        $('.ui.rating').rating();
        $('.menu .item').tab();
      })
    </script>
  </head>

  <body>
    <!-- navigation -->
    <nav>
      <!-- dropdown menu -->
      <div class="ui menu">
        <div class="ui dropdown item" tabindex="0">
          <i class="large bars icon"></i>
          <div class="menu" tabindex="-1">
            <div class="item" id="userinfo">
              <h3>Blossom12</h3>
              <a href="user.php">View account</a>
            </div>
            <a class="item" href="catalogue.php"><i class="leaf icon"></i>Explore</a>
            <a class="item" href="newseed.php"><i class="plus icon"></i>Add listing</a>
            <a class="item" href="exchangelist.php"><i class="exchange icon"></i>Exchanges</a>
              <a class="item" href="catalogue.php?favourite=1"><i class="heart icon"></i>Favourites</a>
            <div class="divider"></div>
            <a class="item" href="help.php"><i class="life ring icon"></i>Help</a>
            <div class="divider"></div>
            <a class="item" href="">Sign Out</a>
          </div>
        </div>

        <!-- logo -->
        <a class="header item" href="index.php">SEED + SHARE</a>
        <img src="img/logo.png" height="45" />

        <div class="right menu">
          <!-- user welcome -->
          <a class="item" href="user.php">Hello, Blossom12!</a>
          <!-- search bar -->
          <div class="item">
            <div class="ui action left icon input">
              <i class="search icon"></i>
              <input type="text" placeholder="Search">
            </div>
          </div>
        </div>
      </div>
    </nav>
