<?php

abstract class Jarmu {
    abstract function Mozogj();
    abstract function Tankolj();
}

class Auto extends Jarmu {

    function Mozogj(){
        print "<br/>Mozgó autó!";
    }

    function Tankolj(){
        print "<br/>Üress a tank!";
    }

    public function __construct(){
        print "<br/>Auto START!";
    }
}

interface IRender {
    public function Render();
}

interface ITextRender {
    public function TextRender();
}

interface IFullRender extends IRender, ITextRender {

}

class HTMLControl implements IFullRender {

    public function Render(){
        print "<br/>interfaceRender";
    }

    public function TextRender(){
        print "<br/>interfaceTextRender";
    }
}