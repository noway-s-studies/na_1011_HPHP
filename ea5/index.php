<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'doctrine.php';
        spl_autoload_register(array("Doctrine","autoload"));
        $manager = Doctrine_Manager::getInstance();

        print Doctrine_Core::getPath();

        //$conn=Doctrine_Manager::connection('mysql://user:pass@localhost/miniforum');
        $conn=Doctrine_Manager::connection('mysql://root:@localhost/miniforum','forumconn');

        $stmt=$conn->prepare("set names utf8");
        $stmt->execute();
        //----------------------------------------------------------

        $stmt=$conn->prepare("select * from uzenet where uzenetid<5");
        $stmt->execute();
        $result=$stmt->fetchAll();
        //print_r($result);
        foreach ($result as $sor) {
            print $sor["szoveg"]."<br>";
        }

        $stmt=$conn->execute("update uzenet set szoveg = ? where uzenetid = ?",
                array("éáűúőóüöíÉÁŰŐÚÖÜÓÍ",8)
                );
        
        print "<hr>";
        $stmt=$conn->execute("SELECT * FROM uzenet WHERE uzenetid < ?",array(3));
        while($sor=$stmt->fetch())
        {
            print_r($sor); print "<br>";
        }

        print "<hr>";
        $stmt=$conn->execute("SELECT * FROM uzenet WHERE szoveg like ?",array("%lehet%"));
        while($sor=$stmt->fetch())
        {
            print_r($sor); print "<br>";
        }

        //include_once 'a.php';
        //require_once 'b.php';

        // egyszer generaljuk !
        //Doctrine_Core::generateModelsFromDb('models',array('forumconn'),
        //        array('generateTableClasses'=>true));

        // betoltes
        Doctrine_Core::loadModels('models');

        // nincs SQL
        $u=new User();
        $u->nev="Gipsz Jakab";
        $u->active=true;
        $u->datum='1999-11-15';
        $u->Save();


        // put your code here
        ?>
    </body>
</html>
