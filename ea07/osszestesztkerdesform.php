<?php

    include_once 'inc/init.php';


    // jogosultsagkezeles: admin
    if(isset($_SESSION["user"])) {
        TesztKerdes::OsszesTesztKerdesForm();
    }


