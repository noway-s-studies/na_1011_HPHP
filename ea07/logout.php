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
<title>Kijelentkezés</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    // ide jon a kod
    session_destroy();
    session_unset();
    print create_uzi("Sikeres kijelentkezés", "accept");

?>
</div>
<script type="text/javascript">
    setTimeout("window.location='index.php'", 3000);
</script>
<?php
    include_once 'inc/footer.php';
?>