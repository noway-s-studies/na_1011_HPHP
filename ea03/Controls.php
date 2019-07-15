<?php
class Control {
    public $Type;
    public $Name;
    public $Class;
    public $Id;
    public $Value;
    public $Click;
    function __construct($name, $type="", $class="", $id=""){
        $this->Name = $name;
        $this->Type = $type;
        $this->Class = $class;
        if($id!="") $this->Id = $id; else $this->Id = $name."_id";
    }
}

class Button extends Control {
    function __construct($name, $value, $class="", $id=""){
        $this->Value = $value;
        parent::__construct($name, "button", $class, $id);
    }
    function Render(){
        $out = "<input ";
        if($this->Type!="") $out .= " type='$this->Type'";
        if($this->Id!="") $out .= " id='$this->Id'";
        if($this->Name!="") $out .= " name='$this->Name'";
        if($this->Class!="") $out .= " class='$this->Class'";
        if($this->Value!="") $out .= " value='$this->Value'";
        if($this->Click!="") $out .= " onclick='$this->Click'";
        $out .= " />";
        print $out;
    }
    function Get(){
        $out = "<input ";
        if($this->Type!="") $out .= " type='$this->Type'";
        if($this->Id!="") $out .= " id='$this->Id'";
        if($this->Name!="") $out .= " name='$this->Name'";
        if($this->Class!="") $out .= " class='$this->Class'";
        if($this->Value!="") $out .= " value='$this->Value'";
        if($this->Click!="") $out .= " onclick='$this->Click'";
        $out .= " />";
        return $out;
    }
}

class Table extends Control {
    public $Sor;
    public $Oszlop;
    public $Cellak = array();
    function __construct($name, $sor=1, $oszlop=1){
        $this->Sor = $sor;
        $this->Oszlop = $oszlop;

        for($i=0; $i<$this->Sor; $i++){
            $this->Cellak[$i] = array();
        }
    }
    function AddControll($sor, $oszlop, $control){
        $this->Cellak[$sor][$oszlop] = $control;
    }
    function Feltolt(){
        for($i=0; $i<$this->Sor; $i++){
            for($j=0; $j<$this->Oszlop; $j++){
                $this->Cellak[$i][$j] = ($i*$this->Oszlop)+$j;
            }
        }
    }
    function Render(){
        $out = "<table border=1>";
        for($i=0; $i<$this->Sor; $i++){
            $out .= "<tr>";
            for($j=0; $j<$this->Oszlop; $j++){
                $out .= "<td>";
                $out .= $this->Cellak[$i][$j];
                $out .= "</td>";
            }
            $out .= "</tr>";
        }
        $out .= "</table>";
        print $out;
    }
}