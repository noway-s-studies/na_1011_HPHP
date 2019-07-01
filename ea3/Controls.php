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
}