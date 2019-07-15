<?php
    include_once 'inc/init.php';
    if(isset($_POST["submit"]))
        $isposted=true;
    else
        $isposted=false;
    if($isposted) {
        $uzenet=array();
        $email="";
        $password="";
        $password2="";
        $nev="";
        $valid=true;
        if(isset($_POST["email"])) $email=$_POST["email"];
        if(isset($_POST["password"])) $password=$_POST["password"];
        if(isset($_POST["password2"])) $password2=$_POST["password2"];
        if(isset($_POST["nev"])) $nev=$_POST["nev"];
        $email=trim($email);
        $password=trim($password);
        $password2=trim($password2);
        $nev=trim($nev);
        if(!validemail($email)) {
            $valid=false;
            array_push($uzenet, create_uzi("Hibás email cím!","error"));
        }
        if(strlen($password)==0 || strlen($password2)==0) {
            $valid=false;
            array_push($uzenet, create_uzi("A jelszó nincs megadva!","error"));
        }
        if($password!=$password2) {
            $valid=false;
            array_push($uzenet, create_uzi("A jelszó és a megismételt jelszó nem egyezik meg!","error"));
        }
        if(strlen($nev)<2) {
            $valid=false;
            array_push($uzenet, create_uzi("Túl rövid név(legyen legalább 2 karakter)!","error"));
        }

        if($valid) {
            array_push($uzenet, create_uzi("Köszöntünk! A regisztrációd sikeres!","accept"));
            array_push($uzenet, create_uzi("Az aktivációs linket elküldtük a megadott email címedre!","accept"));
            $_SESSION["uzenet"]=$uzenet;
            header("Location: index.php"); exit();
        } else {
            $_SESSION["uzenet"]=$uzenet;
            header("Location: register.php"); exit();
        }
    }
    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>BlogMotor - Regisztráció</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
    <?php
        show_uzenet();
    ?>
    <div id="regurlap">
        <form action="register.php" method="post">
            <table>
                <tr><th colspan="2">Regisztrációs adatok</th></tr>
                <tr>
                    <td>Email (login)</td>
                    <td><input type="text" class="editmezo" name="email" id="email" /></td>
                </tr>
                <tr>
                    <td>Jelszó</td>
                    <td><input type="password" class="editmezo" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td>Jelszó mégegyszer</td>
                    <td><input type="password" class="editmezo" name="password2" id="password2" /></td>
                </tr>
                <tr>
                    <td>Megjelenítendő név</td>
                    <td><input type="text" class="editmezo" name="nev" id="nev" /></td>
                </tr>
                <tr><th colspan="2"><input type="submit" value="Elküld" name="submit" /></th></tr>
            </table>
        </form>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>