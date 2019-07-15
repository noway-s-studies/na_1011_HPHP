<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas
    
    if(isset($_SESSION["userreg"])) {
        $user = $_SESSION["userreg"];
        unset($_SESSION["userreg"]);
    }
    else
        $user = new User();
    
    if(isset($_POST['elkuld'])) {
        $user->login=trim($_POST['login']);
        $user->nev=trim($_POST['nev']);
        $user->email=trim($_POST['email']);
        $user->SetPassword(trim($_POST['password']));
        $user->SetPassword2(trim($_POST['password2']));
        
        $uzenet = $user->IsValidUserReg();
        if(count($uzenet)>0) {
            // hibas reg
            $_SESSION["uzenet"] = $uzenet;
            $_SESSION["userreg"] = $user;
            header("Location: register.php"); exit();
        } else {
            // minden ok
            $user->Insert();
            $_SESSION["userreg"] = $user;
            header("Location: sikeresreg.php"); exit();
        }
        
        
        
    }
    
   

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() {
        
            $("#login, #nev, #email").watermark("Kötelező", {useNative: false});
            
        }
    )
</script>
<title>Regisztráció</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
    <H1>Regisztráció</H1>
<?php
    show_uzenet();
?>
    <form action="register.php" method="post">
        <table border="4">
            <tr>
                <td>Felhasználói név</td>
                <td><input type='text' name='login' id='login' value='<?php echo $user->login; ?>' /></td>
            </tr>
            <tr>
                <td>Jelszó</td>
                <td><input type='password' name='password' id='password' value='' /></td>
            </tr>
            <tr>
                <td>Jelszó mégegyszer</td>
                <td><input type='password' name='password2' id='password2' value='' /></td>
            </tr>
            <tr>
                <td>Név</td>
                <td><input type="text" name="nev" id="nev" value='<?php echo $user->nev; ?>' /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" id="email" value='<?php echo $user->email; ?>' /></td>
            </tr>
            <tr>
                <td colspan='2' align='center'><input type="submit" name="elkuld" id="elkuld" value='Regisztrálok' /></td>
            </tr>
        </table>
    </form>
</div>
<?php
    include_once 'inc/footer.php';
?>