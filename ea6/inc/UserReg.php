<?php

// DAL: data access layer: CRUD methods
// doctrine, propel

class UserReg {

    // nev property
    private $nev;
    public function getNev() {
        return $this->nev;
    }
    public function setNev($nev) {
        $this->nev = trim($nev);
    }

    // email property
    private $email;
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    // ----------------

    private static $HibasKivetHibauzenet = "HIbas volt a kivet mert nincs annyi az egyenlegen";

    // pelda csak setter-re
    private $password_sha1;
    public function setPassword($password) {
        $this->password_sha1 = sha1($password);
    }

    // pelda csak getter-re
    private $egyenleg;
    public function getEgyenleg() {
        return $this->egyenleg;
    }
    public function Betesz($money) {
        $this->egyenleg+=$money;
    }
    public function KIvesz($money) {
        if($money<=$this->egyenleg) {
            $this->egyenleg-=$money;
            return true;
        } else return false;
    }

    function __construct() {
        $this->nev="unknow";
    }

}

?>
