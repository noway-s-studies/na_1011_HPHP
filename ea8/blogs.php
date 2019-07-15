<?php
    include_once 'inc/init.php';
    // ide jon a jogosultsagkezeles (lapszintu) validalas
    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>BlogMotor - Blogok</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    $stmt=$conn->execute("select u.uid,u.nev,b.bid,b.cim,b.cikk from Blog b inner join User u on b.uid=u.uid where visible = ?",array(1));
    while($sor = $stmt->fetch()) {
        print "<div class='miniblog'>";
        $link="showblog.php?bid=".$sor['bid'];
        print "<a href='$link'><h4>".$sor['cim']."</h4></a>";
        print "<p>".$sor['nev']."</p>";
        // kinyesni egy darabot
        print "<hr>";
        print "</div>";
    }
?>
</div>
<?php
    include_once 'inc/footer.php';
?>