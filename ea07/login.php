<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas
    if(isset($_POST["elkuld"])) {
        $uzenet = array();
        if(isset($_POST["login"])) $login = $_POST["login"];
        if(isset($_POST["password"])) $password = $_POST["password"];
        $trylogin = USER::TryLogin(trim($login), trim($password));
        if(is_object($trylogin)) {
            array_push($uzenet, create_uzi("Sikeres belépés","accept"));
            $_SESSION["uzenet"]=$uzenet;
            $_SESSION["user"]=$trylogin;
            header("Location: index.php"); exit();
        } else {
            array_push($uzenet, create_uzi($trylogin,"error"));
            $_SESSION["uzenet"]=$uzenet;
            header("Location: login.php"); exit();
        }
        
    }

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
?>
    <form action="login.php" method="POST">
        <table border=="1">
            <tr>
                <td>Felhasználói név</td>
                <td><input  type="text" name="login" id="login" value='' /></td>
            </tr>
            
            <tr>
                <td>jelszó</td>
                <td><input  type="password" name="password" id="password" value='' /></td>
           </tr>           
            
            <tr>
                <td colspan='2' align='center'><input type="submit" name="elkuld" id="elkuld" value='Belépek' /></td>
            </tr>
        </table>
    </form>
</div>
<?php
    include_once 'inc/footer.php';
?>