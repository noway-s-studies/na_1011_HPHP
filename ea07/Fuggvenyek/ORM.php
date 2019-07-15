<?php



// code first
class ORM {
    public $Name; // table name
    
    public $Oszlopok = array();
    public $Tipusok = array();
    public $Ertekek = array();
    
    public $dbhost = "localhost";
    public $dbname = "test";
    public $dbuser = "root";
    public $dbpass = "";

    public $db;
    
    public function __construct($name) {
         $this->db= new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
         $this->Name=$name;
    }
    
    // tabla letrohozasa, letezik e
    // CREATE TABLE IF NOT EXISTS tabla (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id)) ENGINE = InnoDB;
    //select count(*) from information_schema.tables where table_schema='test' and table_name='tabla'
    
    public function CreateTable() {
        $stmt=$this->db->prepare("select count(*), table_name from information_schema.tables where table_schema= ? and table_name= ?");
        $stmt->execute(array($this->dbname, $this->Name));
        $res = $stmt->fetch();
        if($res[0]==0) {
            $stmt=$this->db->prepare("CREATE TABLE IF NOT EXISTS ".$this->Name." (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (id)) ENGINE = InnoDB;");
            $stmt->execute(array());
        } else {
            //print "A tabla letezik<br>";
        }
    }
    
    public function CreateColumns() {
        for ($i = 0; $i < count($this->Oszlopok); $i++) {
            $stmt=$this->db->prepare("select count(*) from information_schema.columns where table_schema= ? and table_name= ? and column_name= ?");
            $stmt->execute(array($this->dbname, $this->Name, $this->Oszlopok[$i]));
            $res = $stmt->fetch();
            if($res[0]==0) {
                $sqltipus="";
                if($this->Tipusok[$i]=="integer") $sqltipus="INT";
                if($this->Tipusok[$i]=="double") $sqltipus="DECIMAL(30,10)";
                if($this->Tipusok[$i]=="string") $sqltipus="VARCHAR(255)";
                $sql="ALTER TABLE ".$this->Name." ADD COLUMN ".$this->Oszlopok[$i]." ".$sqltipus." NULL";
                //print $sql;
                $stmt=$this->db->prepare($sql);
                $stmt->execute(array());
            } else {
                //print "Az oszlop letezik<br>";
            }
        }
    }
    
    public function __set($name, $value) {
        if(!isset($this->Oszlopok[$name])) {
            $this->Oszlopok[]=$name;
            $this->Tipusok[]=gettype($value);
        }
        $this->Ertekek[$name]=$value;
    }
    
    public function Save() {
        $this->CreateTable();
        $this->CreateColumns();
        // dinamikus sql letrehozas
        $sql="insert into ".$this->Name." (".implode(",", $this->Oszlopok).") values("
                .implode(',',array_fill(0,count($this->Oszlopok),"?")).")";
        //print $sql;
        $stmt=$this->db->prepare($sql);
        $values=array();
        for ($i = 0; $i < count($this->Oszlopok); $i++) {
            $values[]=$this->Ertekek[$this->Oszlopok[$i]];
        }
        $stmt->execute($values);
    }
    
}




print gettype(1)."<br>";
print gettype(1.11)."<br>";
print gettype("szoveg")."<br>";
//integer, double, string

/*$x = new ORM("valami");
$x->Oszlopok[]="name";
$x->Tipusok[]="string";
$x->CreateTable();
$x->CreateColumns();*/




$x = new ORM("valami");
$x->name="Jakab";
$x->email="jakab@gmail.com";
$x->tel="20-555-666";
$x->Save();


