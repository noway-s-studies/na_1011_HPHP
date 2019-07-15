<?php

        function ekezet_csere($txt) {
		$mit  = array("á","é","í","ó","ö","ő","ú","ü","ű",
	      				"Á","É","Í","Ó","Ö","Ő","Ú","Ü","Ű",
								"ô","õ","û","ũ","Ô","Õ","Û","Ũ",
								"ä","Ä","ß","§" );
		$mire = array("&#225;","&#233;","&#237;","&#243;","&#246;","&#337;","&#250;","&#252;","&#369;",
									"&#193;","&#201;","&#205;","&#211;","&#214;","&#336;","&#218;","&#220;","&#368;",
									"&#244;","&#245;","&#251;","&#361;","&#212;","&#213;","&#219;","&#360;",
									"&#228;","&#196;","&#223;","&#167;");
		return(str_replace($mit,$mire,$txt)) ;
	}

  function DrawChart($id,$width,$height,$x_val,$y_val,$x_axis,$y_axis,$title) {

	  include_once("pChart/pChart/pData.class");
	  include_once("pChart/pChart/pChart.class");

	  foreach ($x_val as $k => $v)
	  	$x_val[$k]=ekezet_csere($v);

	  // Dataset definition
	  $DataSet = new pData;
	  $DataSet->AddPoint($y_val,"Serie1");
	  $DataSet->AddPoint($x_val,"Serie2");

	  $DataSet->AddSerie("Serie1");
	  $DataSet->SetAbsciseLabelSerie("Serie2");
 		$DataSet->SetSerieName("Adatok","Serie1");

 		$DataSet->SetYAxisName(ekezet_csere($y_axis));
 		$DataSet->SetXAxisName(ekezet_csere($x_axis));

	  // Initialise the graph
	  $w=$width;
	  $h=$height;
	  $pad=50;
	  $Test = new pChart($w,$h);
	  $Test->setFontProperties("pChart/Fonts/tahoma.ttf",8);
	  $Test->setGraphArea($pad+$pad/2,$pad,$w-$pad/2,$h-$pad);
	  $Test->drawFilledRoundedRectangle(7,7,$w-7,$h-7,5,240,240,240);
	  $Test->drawRoundedRectangle(5,5,$w-5,$h-5,5,230,230,230);
	  $Test->drawGraphArea(255,255,255,TRUE); // ha false akkor nincs safrozas
	  $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,100,100,100,TRUE,0,2,TRUE);
	  $Test->drawGrid(1,TRUE,230,230,230,50);

	  // Draw the 0 line
	  $Test->setFontProperties("pChart/Fonts/tahoma.ttf",6);
	  $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

	  // Draw the bar graph
	  $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);

	  // Finish the graph
	  $Test->setFontProperties("pChart/Fonts/tahoma.ttf",8);
	  //$Test->drawLegend($w-200,50,$DataSet->GetDataDescription(),255,255,255);
	  $Test->setFontProperties("pChart/Fonts/tahoma.ttf",10);
	  $Test->drawTitle(50,30,ekezet_csere($title),50,50,50,585);

	  $filename="img_temp/chart_$id.png";
	  $Test->Render($filename);

		return $filename;
}

?>
