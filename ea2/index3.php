<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
    include_once "bankszamla.php";
    $b = new BankSzamla("Gipsz Jakab", 100000);
    $c = new BankSzamla("Robi", 214214123);
    $b_masolat = clone $b;
    $b_masolat->Nev = "Gipsz Jakab2";

    print_r($b); print "<br/>";
    print_r($b);
    print "<br/>";

    print $b->__toString().$c->__toString().$b_masolat->__toString();
    $b->Kamatozz(12);
    $c->Kamatozz(10);
    print $b->__toString().$c->__toString().$b_masolat->__toString();

    $b::NovelKamatlab(10);
    $b->Hamar("asddasd", $c);

    // 0203

?>
</body>
</html>