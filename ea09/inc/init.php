<?php
    $start_time=microtime(true);

    include_once 'inc/UserReg.php';
    include_once 'inc/profiler.php';
    session_start();
    startprofiler("Include Betoltes");
    include_once 'inc/globalvar.php';
    include_once 'inc/configure.php';
    include_once 'inc/db_connect.php';
    include_once 'inc/security.php';
    include_once 'inc/common.php';
    include_once 'inc/sendemail.php';
    stopprofiler("Include Betoltes");

    
?>
