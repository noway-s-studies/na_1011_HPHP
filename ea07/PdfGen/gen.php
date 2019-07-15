<?php

require_once('tcpdf/tcpdf.php');
            
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Gipsz Jakab");
            $pdf->SetTitle("Cim");
            $pdf->SetSubject("Targy");
            
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(10);
            
            $pdf->AddPage();
            $s = "<h2>ez egy valami</h2>";
            $pdf->WriteHTML($s);
            
            $pdf->Output("doksi.pdf");