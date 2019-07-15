<?php

class BankSzamla {
    public $Nev;
    public $Egyenleg;
    public static $EvesKamat = 5;

//    function __construct(){
//    }

    function __construct($n, $e){
        $this->Nev = $n;
        $this->Egyenleg = $e;
    }

    public function __toString(){
        return $this->Nev.": ".$this->Egyenleg."<br/>";
    }

    public function Kamatozz($futamido){
        $alap=1+(self::$EvesKamat/100);
        $this->Egyenleg *= pow($alap, $futamido);
    }

    public static function NovelKamatlab($mennyivel){
        self::$EvesKamat+=$mennyivel;
    }

    public function __call($name, $arguments){
        print "Sajnos ez ({$name}) a metódus nincs implementálva!<br/>";
        print_r($arguments);
        print "<br/>";
    }


}