<?php

class Ember {
    
    public $nev;
    
    public function __construct($nev) {
        $this->nev=$nev;
    }
    
    public function __toString() {
        return "Ember (nev: $this->nev)";
    }
    
    public function __set($name, $value) {
        print "Uj prop hozzadasa tortent: $name = $value: <br>";
    }
    
    public function __call($name, $arguments) {
        print "nem letezo fuggveny hivasa: $name: <br>";
    }
    
    
}

$ember = new Ember("Gipsz Jakab");
print_r($ember);
print "<br>".$ember."<br>";

$ember->email="jakab@gmail.com";

print_r($ember);

$ember->ChangePassword("valami");
