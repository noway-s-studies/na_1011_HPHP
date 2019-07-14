<?php

// pdf generalas
        require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Gipsz Jakab');
	$pdf->SetTitle('Cim');
	$pdf->SetSubject('Subject');
	
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetTopMargin(10); // 10 mm
	
	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set some language dependent data:
	$lg = Array();
	$lg['a_meta_charset'] = 'UTF-8';
	$lg['a_meta_dir'] = 'ltr';
	$lg['a_meta_language'] = 'hu';
	$lg['w_page'] = 'page';
	
	//set some language-dependent strings
	$pdf->setLanguageArray($lg);
	
        $pdf->SetFont('dejavuserif','',10);
        $pdf->AddPage();
        $pdf->WriteHTML("<h2>ez egy h2 szoveg</h2>");
        $pdf->Ln();
        $pdf->WriteHTML("<h1>ez egy h1 szoveg</h1>");
        $pdf->Ln();
        
        $pdf->SetFillColor(245,245,245);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(0.3);

        // szel, mag, szoveg, border, ujsor, igazitas, kitoltes
        $pdf->Cell(70,6,"cella1",1,0,"L",1);
        $pdf->Cell(70,6,"cella2",1,0,"L",0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFontSize(8);
        $pdf->Cell(70,6,"cella1","LT",0,"L",1);
        $pdf->Cell(70,6,"cella1","RB",0,"L",1);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Output("pdfpelda.pdf");
        

?>