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
    include_once 'Controls.php';
    $c = new Control("kontrol");
    $b = new Button("gomb", "Katt!", "gomnok", "gomb_1122");
    $b->Render();

    include_once 'oop.php';
    $a = new Auto();

    $ir = new HTMLControl();
    $ir->Render();
    $ir->TextRender();

    $t = new Table("test",5,8);
    $t->Feltolt();
    $t->Render();

    $t->AddControll(0,0, $b->Get());
    $t->AddControll(3,3, $b->Get());
    $t->AddControll(0,2, $b->Get());
    $t->AddControll(4,1, $b->Get());
    $t->AddControll(4,6, $b->Get());
    $t->Render();
?>
</body>
</html>