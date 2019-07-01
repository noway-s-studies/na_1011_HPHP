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
    include_once 'MDB2.php';
//    $dsn = "mariadb://admin:admin@localhost:3307/forumdb";
    $dsn = "mysql:///admin:admin@localhost:3306/forumdb";
    $opciok = array(
        'portability' => MDB2_PORTABILITY_ALL
    );

    $mdb2 = MDB2::factory($dsn, $opciok);
    if(PEAR::isError($mdb2)){
        print "Kapcsolódási hiba! <br />";
    }

    $sql = "select * from Forum";
    $res = $mdb2->query($sql);
print "4";
    while($row=$res->fatchRow()){
        print_r($row);
        print"<br/><br/>";
    }
print "5";
?>
</body>
</html>