<?php

include_once 'inc/init.php';

$tkid = $_GET["tkid"];
$tvid = $_GET["tvid"];

$kitoltes = new Kitoltes();
$kitoltes->kid=1;
$kitoltes->tid=1;


$kitoltes->KitoltesValaszInsert($tkid, $tvid);