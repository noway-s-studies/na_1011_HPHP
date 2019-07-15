<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        function inc(&$szam) {
            print "erdeti ertek: $szam<br>";
            $szam++;
            print "uj ertek: $szam<br>";
        }
        
        $sz=5;
        inc($sz);
        print "szam: $sz<br>";
        
        function osszead() {
            $args = func_get_args();
            print "parameterk szama: ".count($args)."</br>";
            $osszeg=0;
            foreach ($args as $value) {
                $osszeg+=$value;
            }
            return $osszeg;
        }
        print osszead()."<br>";
        print osszead(5)."<br>";
        print osszead(5,6)."<br>";
        print osszead(5,6,7)."<br>";
        print osszead(5,6,7,8)."<br>";
        
        // n=1*2*3*4*5;
        function fakt($n) {
            if($n<=1) return 1;
            else return $n*fakt($n-1);
        }
        
        print "fakt: ".fakt(5)."<br>";
        
        
        // felteteles fuggvenyek
        $orszag="hu";
        if($orszag=="hu") {
            function telefonszamPrint($korzet,$szam) {
                print "+36-$korzet-$szam";
            }
        }
        if($orszag=="us") {
            function telefonszamPrint($korzet,$szam) {
                print "$korzet-$szam";
            }
        }
        
        print telefonszamPrint("20","5556666")."<br>";
        
        function KulsoFuggveny() {
            print "KulsoFuggveny<br>";
            function BelsoFuggveny() {
                print "BelsoFuggveny<br>";
            }
            BelsoFuggveny();
        }
        KulsoFuggveny();
        BelsoFuggveny();
        
        
        function szavaz($kire) {
            static $darab = 0;
            $darab++;
            print "Koszi a szavazatot: ".$kire."<br>";
            print "Szavazatok eddigi szama: $darab<br>";
        }
        
        szavaz("Gipsz Jakab");
        szavaz("Ketfarku kutyapart");
        szavaz("Vaszlavik Gazember");
        
        $muvelet="osszead";
        print $muvelet(3,4,5)."<br>";
        
        $muvelet="szoroz";
        if(function_exists($muvelet))
            print $muvelet(3,4,5)."<br>";
        
        ?>
    </body>
</html>
