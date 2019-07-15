<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>Title</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    // ide jon a kod
    show_uzenet();
    
    /*print time()."<br>";
    sleep(5);
    print time()."<br>";*/
    
    if(false) { $tk=new TesztKerdes(); }
    
    /*$tk = new TesztKerdes("Mennyi 2+2?", "egyszeres", "matematika", 1.0);
    $tk->Insert();
    
    $tk = TesztKerdes::GetTesztKerdes(2);
    
    var_dump($tk);
    if(is_object($tk)) {
        $tk->kerdestxt="Mennyi a töketlen fecske repülési sebessége?";
        $tk->Update();
        //$tk->Delete();
    }
    */
   //TesztKerdes::OsszesTesztKerdesForm();
  
   print md5($salt."12345");
   
    /*
    $stmt=$db->prepare("select * from tesztkerdesek where kerdestxt like concat(?,?)"); // mysql
    $stmt=$db->prepare("select * from tesztkerdesek where kerdestxt like ? || ?"); //oracle
    $stmt->execute(array("par1","par2"));
    $row = $stmt->fetch();
    */
   
    function DbConcat($p1,$p1) {
        global $dbtype;
        if($dbtype=="mysql") return "concat($p1,$p2)";
        if($dbtype=="oracle") return "$p1 || $p2";
        return "$p1 || $p2";
    }
    
    function DbConcat2() {
        global $dbtype;
        if($dbtype=="mysql") return "concat(?, ?)";
        if($dbtype=="oracle") return "? || ?";
        return "? || ?";
    }
    
    $stmt=$db->prepare("select * from tesztkerdesek where kerdestxt like ".DbConcat2()); // mysql
    $stmt->execute(array("par1","par2"));
    $row = $stmt->fetch();
    
    print "<hr>";
    
    /*$tv = new TesztValasz(2,1,"10 km/h",0);
    $tv->Insert();
    $tv = new TesztValasz(2,2,"nem tudom",0);
    $tv->Insert();
    $tv = new TesztValasz(2,3,"8 bakkfitty/pillantás",1);
    $tv->Insert();
    $tv = new TesztValasz(2,4,"nincs is töketlen fecske",0);
    $tv->Insert();
    $tv = new TesztValasz(2,5,"jobb kérdésed nincs?",0);
    $tv->Insert();
    */
   
   /*$t = Teszt::GetTeszt(1);
   print_r($t);
    
   $kerdesek = Teszt::GetTesztKerdesek(1);
   print_r($kerdesek);*/
    
    
    
?>
</div>
<?php
    include_once 'inc/footer.php';
?>