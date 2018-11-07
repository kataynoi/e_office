<?php
$this->load->library('Pdf');

// initiate FPDI
$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// get the page count
//$pageCount = $pdf->setSourceFile('Laboratory-Report.pdf');
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite4_template.pdf");
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
// import a page
    $templateId = $pdf->importPage($pageNo);
// get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);
// create a page (landscape or portrait depending on the imported page size)
    if ($size['w'] > $size['h']) {
        $pdf->AddPage('L');
    } else {
        $pdf->AddPage('P');
    }

// use the imported page
    $pdf->useTemplate($templateId);
    //$pdf = new MyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetMargins(20, 20, 10, true);
    $pdf->SetAutoPageBreak(true, 50);
    $pdf->setFontSubsetting(false);

// add a page
// อนุญาตให้สามารถกำหนดรุปแบบ ฟอนท์ย่อยเพิมเติมในหน้าใช้งานได้
    //$pdf->setFontSubsetting(true);

// กำหนด ฟอนท์
    $pdf->SetFont('thsarabun', '', 16, '', true);
    //$pdf->AddPage();
// $pdf->SetFont('freeserif', '', 12);
    $perline=6.3;
    $startline=54.7;
    $line[]= array();
    for($i=0; $i<=35; $i++){
        $line[$i]=$startline+($perline*$i);
    }
   switch  ($pageNo){
       case 1:
           $pdf->setXY(110, $line[0]-23);
           $pdf->Cell(300, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'P');
           $pdf->setXY(32, $line[2]);
           $pdf->writeHTML($out_site->detail_no_invit);
           break;
       case 2:
           $pdf->setXY(30, $line[0]);
           $pdf->writeHTML($out_site->detail_no_invit);

           break;
   }

}


// Output the new PDF
$pdf->Output(); 