<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() {
            //$("#pics").cycle();
            //$("#pics").cycle('fade');
            /*$("#pics").cycle(
                { fx: 'scrollDown' }
            )*/
            $("#pics").cycle(
                {
                    fx: "shuffle",
                    delay: -4000
                }
            )
            $("#egesz").numeric(true);
            $("#nemegesz").numeric(false);
        }
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
    // ide jon a kod

    //$eredmeny=SendMail("Vaszlavik Gazember <vaszlavik@valami.hu>","phpjakab@gmail.com", "proba", "hello");
    //print $eredmeny;

?>
    <div id="pics">
        <img src="bannerek/b1.png" />
        <img src="bannerek/b2.png" />
        <img src="bannerek/b3.png" />
        <img src="bannerek/b4.png" />
    </div>
    <br>
    <br>
    <br>
    <br>
    <input type="text" id="egesz" /><br>
    <input type="text" id="nemegesz" />

</div>
<?php
    include_once 'inc/footer.php';
?>