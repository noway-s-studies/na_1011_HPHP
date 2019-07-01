<?php
include_once 'inc/dbconn.php';
array_map(trim, $_POST); // a post minden elemére elvégzi a trim-et
//print "Nick: ".$_POST["nick"]."<br/>";
foreach ($_POST as $key => $value){
//    print "$key = $value <br/>";
}
//print "<hr>";
$valid = true;
$nick = "";
if(isset($_POST["nick"]) &&
    isset($_POST["uzenet"]) &&
    trim($_POST["nick"]) !== "" &&
    trim($_POST["uzenet"]) !==""){
    $nick = $_POST["nick"];
} else {
    $valid = false;
}
if($valid) print "VALID"; else print "INVALID";

if($valid){
    $tipicid = 1;
    $user = $_POST["nick"];
    $uzenet = $_POST["uzenet"];
    $datum = date("Ymd");
    $sql = "INSERT INTO Forum (TopicID, User, Uzenet, Datum) 
            VALUES ({$tipicid}, '{$user}', '{$uzenet}', {$datum});";
    $sql_result = mysqli_query($db_connect, $sql);
    header("Location: index.php");
}
