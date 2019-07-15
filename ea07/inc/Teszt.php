<?php

class Teszt {
    public $tid = 0;
    public $cim;
    
    public function __construct($cim="") {
        $this->cim=$cim;
    }
 
    public static function GetTeszt($tid) {
        global $db;
        $stmt=$db->prepare("select * from tesztek where tid = ?");
        $stmt->execute(array($tid));
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Teszt");
        $row = $stmt->fetch();
        return $row;
    }
    
    public static function GetTesztKerdesek($tid) {
        global $db;
        $sql = "select tk.* from teszt_tesztkerdes tt ";
        $sql .= " inner join tesztkerdesek tk on tk.tkid=tt.tkid where tt.tid = ? ";
        $stmt=$db->prepare($sql);
        $stmt->execute(array($tid));
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "TesztKerdes");
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    public static function TesztkerdesekTable($tid) {
        $t = self::GetTeszt($tid);
        $kerdesek = self::GetTesztKerdesek($tid);
        print "<h3>$t->cim</h3>";
        print "<ul>";
        $kitoltes = new Kitoltes();
        $kitoltes->kid=1;
        $kitoltes->tid=1;
        foreach ($kerdesek as $index => $kerdes) {
            print "<li><a href='#' onClick='Load_TesztKerdes(".$kerdes->tkid.")'>".($index+1).". kérdés</a>";
            if($kitoltes->KitoltesValaszVanE($kerdes->tkid))
              print "<img src='img/cmark24.png' id='img$kerdes->tkid' width=16 height=16 />";
            else
              print "<img src='img/qmark24.png' id='img$kerdes->tkid' width=16 height=16 />";
            print "</li>";
        }
        print "</ul>";
    }
    
    public static function TesztkerdesekPDF($tid) {
        
        require_once('tcpdf/tcpdf.php');
            
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Teszt Jakab");
        $pdf->SetTitle("Teszt");
        $pdf->SetSubject("Teszt");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetTopMargin(10);

        $lg=Array();
        $lg["a_meta_charset"]='UTF-8';
        $lg["a_meta_language"]='hu';
        $pdf->setLanguageArray($lg);
        
        $pdf->SetFont('dejavuserif','', 10);
        
        $pdf->AddPage();
                
        $s="";
        $t = self::GetTeszt($tid);
        $kerdesek = self::GetTesztKerdesek($tid);
        $s.="<h1>$t->cim</h1>";
        foreach ($kerdesek as $index => $kerdes) {
            $s.=TesztKerdes::TesztKerdesUrlapPDFhez($kerdes->tkid);
        }
        
        /*$s.='<table border="1">';
        $s.="<tr><td>1</td><td>2</td></tr>";
        $s.="<tr><td>3</td><td>4</td></tr>";
        $s.="</table>";*/
        
        $pdf->WriteHTML($s);
        $pdf->Output("teszt.pdf");
        
    }
    
}

