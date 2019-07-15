<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    if(!user_is_logged()) {
    	header("Location: noaccess.php"); exit();
    }
    // validalas
    if(isset($_POST["submit"]))
        $isposted=true;
    else
        $isposted=false;

    if($isposted) {
        $uzenet=array();
        $oldpassword="";
        $password="";
        $password2="";
        $valid=true;
        if(isset($_POST["oldpassword"])) $oldpassword=$_POST["oldpassword"];
        if(isset($_POST["password"])) $password=$_POST["password"];
        if(isset($_POST["password2"])) $password2=$_POST["password2"];
        $oldpassword=trim($oldpassword);
        $password=trim($password);
        $password2=trim($password2);
        $u=Doctrine_Core::getTable('User')->find($glob_uid);
        if($u->md5pass!=md5($glob_salt.$oldpassword)) {
            $valid=false;
            array_push($uzenet,create_uzi("A régi jelszó hibás!","error"));
        }
        if(strlen($password)==0 || strlen($password2)==0) {
            $valid=false;
            array_push($uzenet,create_uzi("A jelszó nincs megadva!","error"));
        }
        if($password!=$password2) {
            $valid=false;
            array_push($uzenet,create_uzi("A jelszó és a megismételt jelszó nem egyezik meg!","error"));
        }
        
        if($valid) {
            // update
            $u->md5pass=md5($glob_salt.$password); // sha1
            $u->save();
            array_push($uzenet,create_uzi("Sikeresen megváltoztattuk a jelszót!","accept"));
            $_SESSION["uzenet"]=$uzenet;
            header("Location: changepassword.php"); exit();
        } else {
            $_SESSION["uzenet"]=$uzenet;
            header("Location: changepassword.php"); exit();
        }
        
    }
        

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>BlogMotor - Jelszó módosítása</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    // ide jon a kod
?>
		<div id="changepasswordurlap">
        <form action="changepassword.php" method="post">
            <table>
                <tr><th colspan="2">Jelszó módosítása</th></tr>
                <tr>
                    <td>Régi jelszó</td>
                    <td><input type="password" class="editmezo" name="oldpassword" id="oldpassword" /></td>
                </tr>
                <tr>
                    <td>Új jelszó</td>
                    <td><input type="password" class="editmezo" name="password" id="password" /></td>
                </tr>
                <tr>
                    <td>Új jelszó mégegyszer</td>
                    <td><input type="password" class="editmezo" name="password2" id="password2" /></td>
                </tr>
                <tr><th colspan="2"><input type="submit" value="Elküld" name="submit" /></th></tr>
            </table>
        </form>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>