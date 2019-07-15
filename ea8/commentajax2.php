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
<title>blogmotor</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    $bid=0;
    if(isset($_GET["bid"])) $bid=$_GET["bid"];
    $sql="SELECT c.szoveg,u.nev,c.datum FROM Comment as c ";
    $sql.=" INNER JOIN User as u ON c.uid=u.uid ";
    $sql.=" WHERE c.bid= ? ";
    $stmt=$conn->execute($sql,array($bid));
    while($sor = $stmt->fetch()) {
        print "<p class='commenthead'><img src='img/expand.jpg' >&nbsp;&nbsp;&nbsp;".$sor["nev"]." - <i>".$sor["datum"]."</i></p>";
        print "<div class='commentbody'>";
        print $sor["szoveg"];
        print "</div>";
    }

?>
    <script type="text/javascript">
        $(document).ready(
            function() {
                $('.commentbody').hide();
                $('.commenthead').click(
                    function() {
                        $(this).next('.commentbody').slideToggle(600);
                        var src=$(this).find('img').attr('src');
                        if(src.indexOf('expand')!=-1)
                            $(this).find('img').attr('src','img/collapse.jpg');
                        else
                            $(this).find('img').attr('src','img/expand.jpg');
                    }
                );
            }
        );
    </script>
</div>
<?php
    include_once 'inc/footer.php';
?>