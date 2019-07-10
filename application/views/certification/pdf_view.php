<?php
//$this->load->library('Pdf');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/template.pdf");
// iterate through all pages

    $templateId = $pdf->importPage($pageCount);
        $pdf->AddPage('L');

// use the imported page
    $pdf->useTemplate($templateId, 0, 2, 0, 205);
    //$pdf = new MyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    //$pdf->SetMargins(PDF_MARGIN_LEFT,40, PDF_MARGIN_RIGHT);
    $pdf->SetMargins(0,0, 0);
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->setFontSubsetting(false);
    $pdf->SetTitle('CertificationMahasarakhamDMex2019');

    $pdf->SetFont('thsarabun', 'B', 28, '', true);
    //$pdf->AddPage();
// $pdf->SetFont('freeserif', '', 12);
    $perline=6.3;
    $startline=0;
    $line[]= array();
    for($i=0; $i<=35; $i++){
        $line[$i]=$startline+($perline*$i);
    }
            $pdf->setXY(0, $line[14]+2.5);
            $pdf->Cell(0, 0, $name, 0, 0, 'C');


// Output the new PDF
$pdf->setPrintHeader(true);
$pdf->Output('Mahasarakham_D-Mex2019');