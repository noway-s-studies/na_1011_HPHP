<?php
    $url=$_SERVER["REQUEST_URI"];

    $glob_uid=0;
    $glob_usernev="Vendég";
    $glob_email="";
    $glob_salt="indul a gorog aludni";

    if(isset($_SESSION["uid"])) $glob_uid=$_SESSION["uid"];
    if(isset($_SESSION["usernev"])) $glob_usernev=$_SESSION["usernev"];
    if(isset($_SESSION["email"])) $glob_email=$_SESSION["email"];

?>
