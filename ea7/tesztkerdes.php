<?php

    include_once 'inc/init.php';
    
    usleep(300000);
    
    // jogosultsagkezeles: admin
    if(isset($_SESSION["user"])) {
        if(isset($_GET["tkid"])) $tkid=$_GET["tkid"];
        TesztKerdes::TesztKerdesUrlap($tkid);
    }

