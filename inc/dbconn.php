<?php
    include_once 'config.php';
//    imi_set("display_errors", 0); // hobaózenetek tiltása
//    error_reporting(E_ALL); // miyen tímusu hibát szeretnénk kiíratni
    $db_connect = mysqli_connect($db_host, $db_user, $db_pass); // @ operátor elrejti  a hibát
    if(!$db_connect){die("Unable to connect to MySQL: ".mysqli_connect_error());}
    $selected = mysqli_select_db($db_connect, $db_name);
    if(!$selected){die("Could not select examples: ".mysqli_error());}
    mysqli_query($db_connect, "SET NAMES utf8"); // utf8-as utasítást határoz meg


