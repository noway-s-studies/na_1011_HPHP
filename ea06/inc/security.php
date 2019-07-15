<?php
    add_log("URL", $url);

    $postdata="";
    foreach ($_POST as $key => $value) {
        if(strpos($key,'password')===false)
            $postdata.=">$key = $value< ";
    }
    if(strlen($postdata)>0) add_log("POST",$postdata);

    // vedelem: hacker detektalas
    // jogosultsag figyeles

    function user_try_login($email,$password) {
        global $glob_salt;
        $u=Doctrine_Core::getTable('User')->findOneByEmail($email);
        if(is_object($u)) {
            if($u->md5pass==md5($glob_salt.$password)) {
                // session betoltese
                $_SESSION["uid"]=$u->uid;
                $_SESSION["email"]=$email; // $u->email
                $_SESSION["usernev"]=$u->nev;
                add_log("GOOD-LOGIN","Login: $email");
                return true;
            } else {
                add_log("WRONG-PASSWORD-LOGIN","Login: $email");
                return false;
            }
        } else {
            add_log("BAD-LOGIN","Login: $email");
            return false;
        }
    }


    function user_is_logged() {
        global $glob_uid;
        if(is_numeric($glob_uid) && $glob_uid>0)
            return true;
        else
            return false;
    }


?>