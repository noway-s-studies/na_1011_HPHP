<?php
    include_once 'inc/User.php';
    include_once 'inc/TesztKerdes.php';
    include_once 'inc/TesztValasz.php';
    include_once 'inc/Teszt.php';
    include_once 'inc/Kitoltes.php';

    session_start();

    include_once 'inc/configure.php';
    include_once 'inc/common.php';
    
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, 
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
