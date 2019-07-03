<?php
    // emailcim ellenorzes
    function validemail($email) {
    if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email))
        return true;
    else
        return false;
    }

    // warning: figyelmeztetes
    // error: hiba
    // accept: minden rendben
    function create_uzi($szoveg,$tipus="warning") {
        return "<div class='".$tipus."_uzi'>$szoveg</div>";
        // .warning_uzi
        // .error_uzi
        // .accept_uzi
    }

    function show_uzenet() {
        if(isset($_SESSION["uzenet"]) && is_array($_SESSION["uzenet"])) {
            foreach ($_SESSION["uzenet"] as $uzi) {
            print $uzi;
        }
            unset($_SESSION["uzenet"]);
        }
    }
?>