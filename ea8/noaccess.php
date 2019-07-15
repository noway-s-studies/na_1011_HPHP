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
<title>BlogMotor - Hiba!</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    print create_uzi("Nincs jogosultsága!","error");
    // ide jon a kod
?>
</div>
<?php
    include_once 'inc/footer.php';
?>