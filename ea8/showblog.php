<?php
    include_once 'inc/init.php';
    // ide jon a jogosultsagkezeles (lapszintu) validalas
    $bid=0;
    if(isset($_GET["bid"])) $bid=$_GET["bid"];
    $blog=Doctrine_Core::getTable('Blog')->find($bid);
    if(!is_object($blog)) {
        header("Location: noaccess.php"); exit();
    }
    if(!$blog->visible) {
        header("Location: noaccess.php"); exit();
    }
    $kid=$blog->kid;
    $uid=$blog->uid;
    print "UID: ".$uid;
    $kat=Doctrine_Core::getTable('Kategoria')->find($kid);
    $user=Doctrine_Core::getTable('User')->find($uid);
    $kategorianev=$kat->nev;
    $usernev=$user->nev;
    print "PICTURE: ".$user->picture;
    $kepsrc2=userpicture_url($user->picture);
    $tema=$user->tema;
    $cim=$blog->cim;
    $cikk=$blog->cikk;
    $datum=$blog->datum;
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
?>
    <div id="blog">
        <?php
            print "<img class='bloguserkep' src='$kepsrc2' />";
            print "<h4>$kategorianev</h4>";
            print "<h2>$cim</h2>";
            print "<h4>Szerző: $usernev</h4>";
            print "<div class='cikk'>$cikk</div>";
            print "<p><i>$datum</i></p>";
            print "<hr>";
            $q=Doctrine_Query::create()->from('Blog b')
                                       ->where('b.bid = ?',$bid);
            $blog=$q->execute();
            foreach ($blog[0]->Comment as $c) {
                print $c->szoveg;
                print "<br>";
            }
            print "<hr>";
        ?>
        <textarea cols="30" rows="5" id="szoveg">
        </textarea>
        <br />
        <input type="button" onclick="postcomment()" value="Küldés"/>
        <div id="posteredmeny"></div>
        <hr>
        <div id="commentlisthead">
            Kommentek mutatása&nbsp;&nbsp;&nbsp;
            <img src="img/indicator.gif" class="hidden" id="indicator">
        </div>
        <div id="commentlist" class="hidden"></div>
        <script type="text/javascript">
            function postcomment() {
                var szoveg=$("#szoveg").val();
                var bid=<?php echo $bid; ?>;
                var o = new Object();
                o.szoveg=szoveg;
                o.bid=bid;
                $.post("postcommentajax.php",o,
                    function(data) {
                        $("#posteredmeny").html(data);
                    }
                );
            }
            $("#indicator").ajaxStart(
                function() {
                    $(this).show();
                    $.blockUI({message:"<h3><img src='img/indicator.gif'>Kérem várjon...</h3>" } );
                }
            ).ajaxStop(
                function() {
                    $(this).hide();
                    $.unblockUI();
                }
            );
            $(document).ready(
                function() {
                    var nyitva=0;
                    $("#commentlisthead").click(
                        function() {
                            if(nyitva==0) {
                                //$("#commentlist").hide();
                                $("#commentlist").load('commentajax.php?bid=<?php echo $bid; ?>&rand='+Math.random());
                                $("#commentlist").show(600);
                                nyitva=1;
                            }
                        }
                    );
                }
            );
        </script>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>