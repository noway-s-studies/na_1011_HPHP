<?php
    include_once 'inc/init.php';
    // ide jon a jogosultsagkezeles (lapszintu) validalas
    usleep(2000000);
    $bid=0;
    $szoveg="";
    if(isset($_POST["bid"])) $bid=$_POST["bid"];
    if(isset($_POST["szoveg"])) $szoveg=$_POST["szoveg"];
    $szoveg=trim($szoveg);
    if(ctype_digit($bid) && strlen($szoveg)>0) {
        /*$blog=Doctrine_Core::getTable('Blog')->findOneByBid($bid);
        $blog->Comment[0]->uid=$glob_uid;
        $blog->Comment[0]->szoveg=$szoveg;
        $blog->Comment[0]->visible=true;
        $blog->Comment[0]->datum=date('Y-m-d H:i:s');
        $blog->Save();
         */
        $c=new Comment();
        $c->bid=$bid;
        $c->uid=$glob_uid;
        $c->szoveg=$szoveg;
        $c->visible=true;
        $c->datum=date('Y-m-d H:i:s');
        $c->Save();
        print create_uzi("Sikeresen mentettük az kommentet!", "accept");
    } else {
        print create_uzi("Nem sikerült", "error");
    }
?>