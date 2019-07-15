<?php

    include_once 'inc/init.php';
    
    usleep(300000);
    
    // jogosultsagkezeles: admin
    if(isset($_SESSION["user"])) {
        $isposted = isset($_POST["tkid"]);
        $tkid=0;
        if(isset($_GET["tkid"])) $tkid=$_GET["tkid"];
        if($isposted) {
            $tkid=$_POST["tkid"];
            TesztKerdes::TesztKerdesForm($isposted, $tkid, $_POST["kerdestxt"],
                    $_POST["tipus"], $_POST["kategoria"], $_POST["nehezseg"]);            
        } else TesztKerdes::TesztKerdesForm(false, $tkid);
    }

