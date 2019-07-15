<?php

class TesztKerdes {
    public $tkid = 0;
    public $kerdestxt;
    public $kerdeshtml;
    public $kerdesbin;
    public $tipus;     // egyszeres, többszörös
    public $kategoria; // angol, biológia, matematika, történelem
    public $nehezseg;
    
    public static $KerdesTipusok = array("egyszeres", "többszörös");
    public static $KerdesKategoriak = array("angol", "biológia", "matematika", "történelem");
    
    public function __construct($kerdestxt="",$tipus="",$kategoria="",$nehezseg="") {
        $this->kerdestxt=$kerdestxt;
        $this->tipus=$tipus;
        $this->kategoria=$kategoria;
        $this->nehezseg=$nehezseg;
    }
    
    // lekerdezo muveletek
    public static function GetTesztKerdes($tkid) {
        global $db;
        $stmt=$db->prepare("select * from tesztkerdesek where tkid = ?");
        $stmt->execute(array($tkid));
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztKerdes");
        $row = $stmt->fetch();
        return $row;
    }
    
    public static function GetTesztKerdesek() {
        global $db;
        $stmt=$db->prepare("select * from tesztkerdesek");
        $stmt->execute(array());
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztKerdes");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    // CRUD (create, update, delete)
    
    public function Insert() {
        global $db;
        $stmt = $db->prepare("insert into tesztkerdesek (kerdestxt, kerdeshtml, kerdesbin, tipus, kategoria, nehezseg) values (?,?,?,?,?,?)");
        $stmt->execute(array($this->kerdestxt,$this->kerdeshtml,$this->kerdesbin,$this->tipus,$this->kategoria,$this->nehezseg));
    }
    public function Update() {
        global $db;
        $stmt = $db->prepare("update tesztkerdesek set kerdestxt=?, kerdeshtml=?, kerdesbin=?, tipus=?, kategoria=?, nehezseg=? where tkid = ?");
        $stmt->execute(array($this->kerdestxt,$this->kerdeshtml,$this->kerdesbin,$this->tipus,$this->kategoria,$this->nehezseg,$this->tkid));
    }
    public function Delete() {
        global $db;
        $stmt = $db->prepare("delete from tesztkerdesek where tkid=?");
        $stmt->execute(array($this->tkid));
    }
    
    public static function TesztKerdesForm($isposted=false, $tkid=0,$kerdestxt="",$tipus="",$kategoria="",$nehezseg="") {
        $uzenet=array();
        $iserror=false;
        
        if(!$isposted && $tkid>0) {
            $tk = self::GetTesztKerdes($tkid);
        } else {
            $tk = new TesztKerdes($kerdestxt, $tipus, $kategoria, $nehezseg);
            $tk->tkid=$tkid;
        }
        
        if($isposted) {
            if(strlen($kerdestxt)==0)
                $uzenet[]=create_uzi ("Hiányzó tesztkérdés", "error");
            
            if(count($uzenet)==0) {
                if($tkid==0) {
                    $tk->Insert();
                    $uzenet[]=create_uzi ("Sikeres felvitel", "accept");
                } else {
                    $tk->Update();
                    $uzenet[]=create_uzi ("Sikeres módosítás", "accept");
                }
            } else $iserror=true;
        }
        
        print '<head><meta charset="UTF-8" /></head>';
        print "<div id='tesztkerdesform'>";
        foreach ($uzenet as $uzi) {
            print $uzi;
        }
        if(!$isposted || $iserror) {
            print "<script type='text/javascript'>";
            print "jQuery().ready(";
            print "function() { $('#nehezseg').numeric('.'); }";
            print ")";
            print "</script>";
            print "<form action='#' method='post'>";
            print "<input type='hidden' name='tkid' id='tkid' value='$tkid' >";
            print "<table border='4'>";
            print "<tr>";
            print "    <td>Kérdés</td>";
            print "    <td><input class='editmezo' type='text' name='kerdestxt' id='kerdestxt' value='$tk->kerdestxt' /></td>";
            print "</tr>";
            
            print "<tr>";
            print "    <td>Típus</td>";
            print "    <td>";
            print "<select class='editmezo' name='tipus' id='tipus' >";
            foreach (self::$KerdesTipusok as $kt) {
                if($tk->tipus==$kt)
                    print "<option value='$kt' selected='selected'>$kt";
                else
                    print "<option value='$kt'>$kt";
            }
            print "</select>";
            print "    </td>";
            print "</tr>";
            
            print "<tr>";
            print "    <td>Kategória</td>";
            print "    <td>";
            print "<select class='editmezo' name='kategoria' id='kategoria' >";
            foreach (self::$KerdesKategoriak as $kk) {
                if($tk->kategoria==$kk)
                    print "<option value='$kk' selected='selected'>$kk";
                else
                    print "<option value='$kk'>$kk";
            }
            print "</select>";
            print "    </td>";
            print "</tr>";
            
            print "<tr>";
            print "    <td>Nehézség</td>";
            print "    <td><input class='editmezo' type='text' name='nehezseg' id='nehezseg' value='$tk->nehezseg' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td colspan='2' align='center'><input type='button' name='elkuld' id='elkuld' value='Mentés' onClick='Save_TesztKerdesForm();' /></td>";
            print "</tr>";
            print "</table>";
            print "</form>";
            
            if($tkid>0) {
                print "<p /><p /><p />";
                print "<input type='button' onClick='Load_TesztValaszForm($tk->tkid)' value='Új tesztválasz'>";
                print "<p /><p /><p />";
                TesztValasz::TesztValaszokTable($tkid);
            }
        }
        print "</div>";
    }
    
    public static function OsszesTesztKerdesForm() {
        global $cache_folder;
        global $cache_time1;
        
        $cache_filename = $cache_folder."osszestesztkerdes.html";
        //$cache_filename = $cache_folder."tesztkerdes_$tkid.html";
        
        if(file_exists($cache_filename)) {
            $cache_created = filemtime($cache_filename);
        } else $cache_created = 0;
        
        if(time()-$cache_created>$cache_time1) {
            ob_start();
            print '<head><meta charset="UTF-8" /></head>';
            print "<script type='text/javascript'>";
            print "jQuery().ready(";
            print "function() { $('#osszestesztkerdestable').dataTable({ 'oLanguage': {'sUrl': 'dataTables.hungarian.txt'}}); }";
            print ")";
            print "</script>";
            print "Datum: ".date("Y-m-d H:i:s", strtotime("now"));
            print "<div id='osszestesztkerdesform'>";
            print "<table border='4' class='stripe hover' id='osszestesztkerdestable'>";
            print "<thead><tr>";
            print "    <th>tkid</th>";
            print "    <th>kerdestxt</th>";
            print "    <th>tipus</th>";
            print "    <th>kategoria</th>";
            print "    <th>nehezseg</th>";
            print "</tr></thead>";        
            print "<tfoot><tr>";
            print "    <th>tkid</th>";
            print "    <th>kerdestxt</th>";
            print "    <th>tipus</th>";
            print "    <th>kategoria</th>";
            print "    <th>nehezseg</th>";
            print "</tr></tfoot>";        
            print "<tbody>";
            foreach (self::GetTesztKerdesek() as $tk) {
                print "<tr>";
                print "    <td>$tk->tkid</td>";
                print "    <td><a href='#' onClick='Load_TesztKerdesForm($tk->tkid)'> $tk->kerdestxt</a></td>";
                print "    <td>$tk->tipus</td>";
                print "    <td>$tk->kategoria</td>";
                print "    <td>$tk->nehezseg</td>";
                print "</tr>";
            }
            print "</tbody>";
            print "</table>";
            print "</div>";
            $c = ob_get_contents();
            file_put_contents($cache_filename, $c);
            ob_end_flush();
        } else {
            readfile($cache_filename);
        }            
    }
    
    public static function TesztKerdesUrlap($tkid) {
        $tk = self::GetTesztKerdes($tkid);
        $valaszok = TesztValasz::GetTesztValaszok($tkid);        
        print '<script type="text/javascript">';
        print 'jQuery().ready(';
        print "function() { $('#middle :radio').on('change', function() { SendValasz($tkid, $(this).val()); }); }";
        print ')';
        print '</script>';
        print "<h3>$tk->kerdestxt</h3>";
        print "<ul>";
        // ide van robbantva minden, ez nem helyes
        $kitoltes = new Kitoltes();
        $kitoltes->kid=1;
        $kitoltes->tid=1;
        foreach ($valaszok as $valasz) {
            $checked="";
            if($kitoltes->KitoltesValaszChecked($tkid, $valasz->tvid))
                    $checked="checked='checked'";
            print "<li><input type='radio' name='valasz' id='tvid$valasz->tvid' $checked value='$valasz->tvid'>$valasz->valasztxt</li>";
        }
        print "</ul>";
    }
    
    public static function TesztKerdesUrlapPDFhez($tkid) {
        $tk = self::GetTesztKerdes($tkid);
        $valaszok = TesztValasz::GetTesztValaszok($tkid);
        $s="";
        $s.='<table border="1">';
        $s.='<tr>';
        $s.="<td><h3>$tk->kerdestxt</h3></td>";
        $s.='</tr>';
        foreach ($valaszok as $valasz) {
            $s.='<tr>';
            $s.='<td>&#9675;&nbsp;&nbsp;&nbsp;'.$valasz->valasztxt.'</td>';
            $s.='</tr>';
        }
        $s.='</table>';
        $s.="<p></p>";
        return $s;
    }
    
    
}
