<?php
    include_once 'inc/init.php';
    // ide jon a jogosultsagkezeles (lapszintu) validalas
    if(!user_is_logged()) {
        header("Location: noaccess.php"); exit();
    }
    if(isset($_POST["submit"]))
        $isposted=true;
    else
        $isposted=false;
    if($isposted) {
        $uzenet=array();
        $nev="";
        $tema="";
        $valid=true;
        if(isset($_POST["nev"])) $nev=$_POST["nev"];
        if(isset($_POST["tema"])) $tema=$_POST["tema"];
        $nev=trim($nev);
        $tema=trim($tema);
        if(strlen($nev)<2) {
            // itt meg lehetnek problemak (speci karakterek, script)
            $valid=false;
            array_push($uzenet,create_uzi("Túl rövid név(legyen legalább 2 karakter)!","error"));
        }
        if(strlen($tema)==0) {
            $valid=false;
            array_push($uzenet,create_uzi("A téma nincs megadva!","error"));
        }
        if($valid) {
            $u=Doctrine_Core::getTable('User')->find($glob_uid);
            $_SESSION["usernev"]=$nev;
            $u->nev=$nev;
            $u->tema=$tema;
            array_push($uzenet,create_uzi("Sikeresen módosítottuk az adatokat","accept"));
            // kepfeldolgozas
            if(file_exists(trim($_FILES["picture"]["tmp_name"])) &&
                  $_FILES["picture"]["size"]>0) {
                $file_type=$_FILES["picture"]["type"]; // ez is lehet fertozott
                //print "type=".$file_type;
                $tmp_name=$_FILES["picture"]["tmp_name"];
                // felejtos:
                //$name=$_FILES["picture"]["name"];
                $name=$glob_uid.pics_extension($file_type);
                $destination=$glob_userpicdir.$name;
                move_uploaded_file($tmp_name, $destination);
                $u->picture=$name;
                array_push($uzenet,create_uzi("A képet sikeresen elmentettük!","accept"));
            }
            $u->save();
            $_SESSION["uzenet"]=$uzenet;
            header("Location: useredit.php"); exit();
        } else {
            $_SESSION["uzenet"]=$uzenet;
            header("Location: useredit.php"); exit();
        }
    }
    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>BlogMotor - Adatok szerkesztése</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    $u=Doctrine_Core::getTable('User')->find($glob_uid);
    $nev=$u->nev;
    $tema=$u->tema;
    $picture=$u->picture;
?>
    <div id="userediturlap">
        <form action="useredit.php" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th colspan="2">Adatok szerkesztése</th>
                </tr>
                <tr>
                    <td>Megjelenítendő név</td>
                    <td><input type="text" value="<?php echo $nev; ?>" class="editmezo" name="nev" id="nev" /></td>
                </tr>
                <tr>
                    <td>Téma</td>
                    <td>
                        <select name="tema" id="tema">
                            <?php
                            foreach ($glob_temak as $key => $value) {
                                if($key==$tema) $sel="selected"; else $sel="";
                                print "<option value='$key' $sel>$value</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Kép</td>
                    <td><input type="file" id="picture" name="picture"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <img class="userkep" src="<?php echo userpicture_url($picture); ?>" />
                    </td>
                </tr>
                <tr><th colspan="2"><input type="submit" value="Elküld" name="submit" /></th></tr>
            </table>
        </form>
    </div>
</div>
<?php
    include_once 'inc/footer.php';
?>