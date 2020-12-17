<?php
//$this->load->library('Pdf');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
for($i =1;$i<=6;$i++){
    $pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite".$i."_template.pdf");
    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $pdf->importPage($pageNo);
        $pdf->AddPage('P');
        $pdf->useTemplate($templateId);
        //$pdf = new MyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetMargins(PDF_MARGIN_LEFT,40, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->setFontSubsetting(false);
        $pdf->SetTitle('ขออนุญาตไปราชการ_'.$out_site->date_permit);

        $pdf->SetFont('thsarabun', '', 16, '', true);
    }

}
// Output the new PDF
$pdf->setPrintHeader(true);
$pdf->Output('outsite_'.$out_site->date_permit);