<?php

class TesztValasz {
    public $tvid = 0;
    public $tkid;
    public $sorszam = 1;
    public $valasztxt;
    public $valaszhtml;
    public $valaszbin;
    public $helyese = 0;
    
    public function __construct($tkid=0, $sorszam=1, $valasztxt="", $helyese=0) {
        $this->tkid = $tkid;
        $this->sorszam = $sorszam;
        $this->valasztxt = $valasztxt;
        $this->helyese = $helyese;
    }
    
    // lekerdezo muveletek
    public static function GetTesztValasz($tvid) {
        global $db;
        $stmt=$db->prepare("select * from tesztvalaszok where tvid = ?");
        $stmt->execute(array($tvid));
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztValasz");
        $row = $stmt->fetch();
        return $row;
    }
    
    public static function GetTesztValaszok($tkid) {
        global $db;
        $stmt=$db->prepare("select * from tesztvalaszok where tkid = ?");
        $stmt->execute(array($tkid));
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztValasz");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    // CRUD (create, update, delete)
    
    public function Insert() {
        global $db;
        $stmt = $db->prepare("insert into tesztvalaszok (tkid, sorszam, valasztxt, valaszhtml, valaszbin, helyese) values (?,?,?,?,?,?)");
        print "insert into tesztvalaszok (tkid, sorszam, valasztxt, valaszhtml, valaszbin, helyese) values (?,?,?,?,?,?)<br>";
        $stmt->execute(array($this->tkid, $this->sorszam, $this->valasztxt,$this->valaszhtml,$this->valaszbin,$this->helyese));
    }
    public function Update() {
        global $db;
        $stmt = $db->prepare("update tesztvalaszok set tkid=?, sorszam=?, valasztxt=?, valaszhtml=?, valaszbin=?, helyese=? where tvid = ?");
        $stmt->execute(array($this->tkid, $this->sorszam, $this->valasztxt,$this->valaszhtml,$this->valaszbin,$this->helyese,$this->tvid));
    }
    public function Delete() {
        global $db;
        $stmt = $db->prepare("delete from tesztvalaszok where tvid=?");
        $stmt->execute(array($this->tvid));
    }
    
    public static function TesztValaszokTable($tkid) {
        print "<table border='4' id='tesztvalaszoktable'>";
        print "<thead>";
        print "<tr><td>tvid</td><td>sorszam</td><td>valasztxt</td><td>helyese</td></tr>";
        print "</thead>";
        print "<tfoot>";
        print "<tr><td>tvid</td><td>sorszam</td><td>valasztxt</td><td>helyese</td></tr>";
        print "</tfoot>";
        print "<tbody>";
        foreach (self::GetTesztValaszok($tkid) as $tv) {
            print "<tr>";
            print "<td>$tv->tvid</td>";
            print "<td>$tv->sorszam</td>";
            print "<td><a href='#' onClick='Load_TesztValaszForm($tkid,$tv->tvid)'>$tv->valasztxt</a></td>";
            if($tv->helyese)
                print "<td><input type='checkbox' checked='checked' disabled='disabled'></td>";
            else 
                print "<td><input type='checkbox' disabled='disabled'></td>";
            print "</tr>";
        }
        print "</tbody>";
        print "</table>";
    }
    
    
    public static function TesztValaszForm($isposted=false, $tkid=0, $tvid=0, $sorszam=1, $valasztxt="", $helyese=0) {
        $uzenet=array();
        $iserror=false;
        
        if(!$isposted && $tvid>0) {
            $tv = self::GetTesztValasz($tvid);
        } else {
            $tv = new TesztValasz($tkid, $sorszam, $valasztxt, $helyese);
            $tv->tvid=$tvid;
        }
        
        if($isposted) {
            if(strlen($valasztxt)==0)
                $uzenet[]=create_uzi ("Hiányzó tesztválasz", "error");
            
            if(count($uzenet)==0) {
                if($tvid==0) {
                    $tv->Insert();
                    $uzenet[]=create_uzi ("Sikeres felvitel", "accept");
                } else {
                    $tv->Update();
                    $uzenet[]=create_uzi ("Sikeres módosítás", "accept");
                }
            } else $iserror=true;
        }
        
        print '<head><meta charset="UTF-8" /></head>';
        print "<div id='tesztvalaszform'>";
        foreach ($uzenet as $uzi) {
            print $uzi;
        }
        if(!$isposted || $iserror) {
            print "<script type='text/javascript'>";
            print "jQuery().ready(";
            // ???? egesz szam
            print "function() { $('#sorszam').numeric('.'); }";
            print ")";
            print "</script>";
            print "<form action='#' method='post'>";
            print "<input type='hidden' name='tkid' id='tkid' value='$tkid' >";
            print "<input type='hidden' name='tvid' id='tvid' value='$tvid' >";
            print "<table border='4'>";
            print "<tr>";
            print "    <td>Sorszám</td>";
            print "    <td><input class='editmezo' type='text' name='sorszam' id='sorszam' value='$tv->sorszam' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td>Válasz</td>";
            print "    <td><input class='editmezo' type='text' name='valasztxt' id='valasztxt' value='$tv->valasztxt' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td>Helyes-e</td>";
            if($tv->helyese) $checked="checked='checked'"; else $checked="";
            print "    <td><input class='editmezo' type='checkbox' name='helyese' id='helyese' $checked/></td>";
            print "</tr>";
            print "<tr>";
            print "    <td colspan='2' align='center'><input type='button' name='elkuld' id='elkuld' value='Mentés' onClick='Save_TesztValaszForm();' /></td>";
            print "</tr>";
            print "</table>";
            print "</form>";
        }
        print "</div>";
    }
    
    
}
