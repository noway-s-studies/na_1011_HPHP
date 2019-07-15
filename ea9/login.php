<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    if(isset($_POST["submit"]))
        $isposted=true;
    else
        $isposted=false;

    if($isposted) {
        $uzenet=array();
        $email="";
        $password="";
        if(isset($_POST["email"])) $email=$_POST["email"];
        if(isset($_POST["password"])) $password=$_POST["password"];
        $email=trim($email);
        $password=trim($password);

        if(strlen($email)>0 && strlen($email)<255 &&
           strlen($password)>0 && strlen($password)<255 &&
           user_try_login($email,$password)) {
           array_push($uzenet,create_uzi("Sikeres belépés!","accept"));
           $_SESSION["uzenet"]=$uzenet;
           header("Location: index.php"); exit();
        } else {
           array_push($uzenet,create_uzi("Hibás felhasználói név vagy jelszó!","error"));
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
<title>BlogMotor - Bejelentkezés</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    // ide jon a kod
?>
    <div id="loginurlap">
        <form action="login.php" method="post">
            <table>
                <tr>
                    <th colspan="2">Bejelentkezési adatok</th>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" class="editmezo" name="email" id="email" /></td>
                </tr>
                <tr>
                    <td>Jelszó</td>
                    <td><input type="password" class="editmezo" name="password" id="password" /></td>
                </tr>
                <tr>
                    <th colspan="2"><input type="submit" value="Belépés" name="submit" /></th>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>