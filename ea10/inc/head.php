<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
  <?php
    $phplap=basename($_SERVER["PHP_SELF"]);
    if($phplap=="showblog.php") {
        // kategoria
        // szerzo
        // cim
        $bid=$_GET["bid"];
        $sql="select b.cim,u.nev as usernev,k.nev as kategoria from blog as b
            inner join user as u on u.uid=b.uid
            inner join kategoria as k on k.kid=b.kid
            where b.bid= ?";
        $stmt=$conn->execute($sql,array($bid));
        $f=$stmt->fetch();
        $description=$f["cim"].", ".$f["usernev"].", ".$f["kategoria"];
        $keywords=$description;
    } else {
        $description="blogmotor";
        $keywords="";
    }
    print '<meta name="description" content="'.$description.'" />';
    print '<meta name="keywords" content="'.$keywords.'" />';
  ?>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="content-language" content="hu" />
  <meta name="language" content="hungarian, HU" />

  <link rel="stylesheet" type="text/css" href="css/style.css" />

  <?php
    $U=Doctrine_Core::getTable('User')->find($glob_uid);
    $Tema=$U->tema;
    if(strlen(trim($Tema))>0)
        print "<link rel='stylesheet' type='text/css' href='css/$Tema.css' />";
    // hazi
    // gondolat: kiveve showblog.php, ott masik tema
  ?>

    <script type='text/javascript' src='jquery/jquery-1.4.2.js'></script>
    <script type="text/javascript" src="jquery/jquery.watermark.js"></script>
    <!--[if IE]><script type="text/javascript" src="jquery/excanvas.js" charset="utf-8"></script><![endif]-->
    <script type="text/javascript" src="jquery/jquery.bt.js" charset="utf-8"></script>
    <script type="text/javascript" src="jquery/jquery.blockUI.js" charset="utf-8"></script>
    <script type="text/javascript" src="jquery/jquery.simplespy.js" charset="utf-8"></script>
    <script type="text/javascript" src="jquery/jquery.cycle.all.js" charset="utf-8"></script>
    <script type="text/javascript" src="jquery/jquery.numeric.js" charset="utf-8"></script>


    <script type="text/javascript">
           jQuery().ready(
                function() {
                    //$("ul.spy").simpleSpy();
                }
           );
    </script>