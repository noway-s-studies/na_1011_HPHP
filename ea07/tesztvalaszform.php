<?php

    include_once 'inc/init.php';
    
    usleep(300000);
    
    print_r($_POST);
    print "Valasztxt: ".$_POST["valasztxt"];
    print "Helyese: ".$_POST["helyese"];
    
    // jogosultsagkezeles: admin
    if(isset($_SESSION["user"])) {
        $isposted = isset($_POST["tkid"]);
        $tkid=0;
        $tvid=0;
        if(isset($_GET["tkid"])) $tkid=$_GET["tkid"];
        if(isset($_GET["tvid"])) $tvid=$_GET["tvid"];
        if($isposted) {
            $tkid=$_POST["tkid"];
            $tvid=$_POST["tvid"];
            
            TesztValasz::TesztValaszForm($isposted, $tkid, $tvid, $_POST["sorszam"],
                    $_POST["valasztxt"], $_POST["helyese"]);            
        } else TesztValasz::TesztValaszForm(false, $tkid, $tvid);
    }

