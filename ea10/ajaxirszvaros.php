<?php
    // kell egy lista
    $irszvaros =array(
    '8128'=>'Aba',
    '8127'=>'Aba',
    '5241'=>'Abádszalók',
    '7678'=>'Abaliget',
    '3261'=>'Abasár',
    '3882'=>'Abaújalpár',
    '3882'=>'Abaújkér',
    '3815'=>'Abaújlak',
    '3881'=>'Abaújszántó',
    '3809'=>'Abaújszolnok',
    '3898'=>'Abaújvár',
    '9151'=>'Abda',
    '3753'=>'Abod'
    );

    $irsz="";
    if(isset($_POST["irsz"])) $irsz=$_POST["irsz"];

    $varos=$irszvaros[$irsz];
    if($varos=="") print "hibas irsz"; else print $varos;

?>