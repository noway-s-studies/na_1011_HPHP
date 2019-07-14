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
<title>BlogMotor - kijelentkezés</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    // ide jon a kod
    add_log("LOGOUT","Usernev: ".$glob_usernev);
    session_destroy();
    session_unset();
    print create_uzi("Sikeres kijelentkezés!","accept");
?>
    <script type="text/javascript">
        setTimeout("window.location='index.php'",4000);
    </script>
</div>
<?php
    include_once 'inc/footer.php';
?>