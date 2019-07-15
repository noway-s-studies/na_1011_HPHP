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
?>
    <h2>Köszönjük kedves <?php echo $_SESSION["userreg"]->nev; unset($_SESSION["userreg"]); ?> a regisztációját!</h2>
</div>
<?php
    include_once 'inc/footer.php';
?>