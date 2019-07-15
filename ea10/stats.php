<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>blogmotor</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
<?php
    show_uzenet();
    // ide jon a kod

    $sql="SELECT count(*) darab,month(datum) honap FROM log
  where event='URL'
  group by month(datum)";

    $stmt=$conn->execute($sql);
    print "<table>";
    print "<tr><th>Hónap</th><th>Nézettség</th></tr>";
    $x=array();
    $y=array();
    while($f=$stmt->fetch()) {
        $x[]=honapnev($f["honap"]);
        $y[]=$f["darab"];
        print "<tr><th>".$f["honap"]."</th><th>".$f["darab"]."</th></tr>";
    }
    print "</table>";

    include_once 'inc/chart.php';
    print "<h2>Grafikon</h2>";
    $id="honapstat";
    $xfelirat="hónap";
    $yfelirat="nézettség";
    $filename=DrawChart($id, 500, 400, $x, $y, $xfelirat, $yfelirat, "Havi statisztika");
    print "<img src='$filename?rand=".rand()."' alt='Havi statisztika' title='Havi statisztika' >";


    // excel megvalositas

    // ------------------- EXCEL ---------------------
	require_once 'phpexcel/Classes/PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Gipsz Jakab")
                                     ->setLastModifiedBy("GipszJakab")
                                     ->setTitle("Stat Űrlap")
                                     ->setSubject("Stat Űrlap")
                                     ->setDescription("Stat Űrlap")
                                     ->setKeywords("Stat Űrlap")
                                     ->setCategory("statisztika");

        // Rename sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('Statisztika');
        // Add some data
        $sheet=$objPHPExcel->getActiveSheet();

        function cellkiir($sheet,$c,$string,$type="text",$style="",$size=12,$wrap=false) {
            $sheet->setCellValue($c,$string);
            if(strpos($style,"B")!==false) $sheet->getStyle($c)->getFont()->setBold(true);
            if(strpos($style,"I")!==false) $sheet->getStyle($c)->getFont()->setItalic(true);
            $sheet->getStyle($c)->getFont()->setSize($size);
            if($wrap) $sheet->getStyle($c)->getAlignment()->setWrapText(true);
            if($type=="general") $sheet->getStyle($c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_GENERAL);
            if($type=="text") $sheet->getStyle($c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
            if($type=="number2") $sheet->getStyle($c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            if($type=="number4") $sheet->getStyle($c)->getNumberFormat()->setFormatCode('0.0000');
            if($type=="date") $sheet->getStyle($c)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
        }

        // 0-val kezdodoen
        function nthABC($n) {
            $c=ord('A');
            if($n>25){
                $elso=(int)$n/26;
                $masodik=$n%26;
                return chr($c+$elso-1).chr($c+$masodik);
            }
            else return chr($c+$n);
        }

        print nthABC(0)."<br>";
        print nthABC(1)."<br>";
        print nthABC(25)."<br>";
        print nthABC(26)."<br>";
        print nthABC(250)."<br>";
        $sheet->getColumnDimension("A")->setWidth(15);
        $sheet->getColumnDimension("B")->setWidth(15);

        cellkiir($sheet,"A1","Hónap","text","B");
        cellkiir($sheet,"B1","darab","text","B");
        for($i=0;$i<count($x);$i++) {
            cellkiir($sheet,"A".($i+2),$x[$i],"text","B");
            cellkiir($sheet,"B".($i+2),$y[$i],"general","B");
        }

        cellkiir($sheet,"C4","=B4*3","general");
        cellkiir($sheet,"C5","=sum(B2:B5)","general");

        $objwriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $filename="excel_temp/stat.xls";
        $objwriter->save($filename);

        print "<a href='$filename?rand=".rand()."'>Stat Excel formátumban";
        print "<img class='noborder' src='img/excel32x32.png' />";
        print "</a>";

        // --------------------------------------------------------------
        
?>
</div>
<?php
    include_once 'inc/footer.php';
?>