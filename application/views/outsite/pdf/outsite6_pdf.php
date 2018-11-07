<?php
$this->load->library('Pdf');

// initiate FPDI
$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// get the page count
//$pageCount = $pdf->setSourceFile('Laboratory-Report.pdf');
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite6_template.pdf");
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
    $pdf->SetMargins(20, 20, 20, true);
    $pdf->SetAutoPageBreak(true, 20);
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
            $pdf->setXY(32, $line[1]+2);
            $pdf->writeHTML($out_site->detail_no_invit,1);



            //$pdf->setXY(54, $line[0]);
            //$pdf->writeHTML($out_site->detail_no_invit);


           /* $pdf->setXY(138, $line[5]);
            $pdf->Cell(250, 20, $out_site->claim_type, 0, 0, 'L');
            $pdf->setXY(66, $line[6]);
            $pdf->Cell(250, 20, $out_site->permit_user, 0, 0, 'L');
            $pdf->setXY(132, $line[6]);
            $pdf->Cell(250, 20, $out_site->permit_position, 0, 0, 'L');
            $pdf->setXY(86, $line[7]);
            $pdf->Cell(250, 20, $out_site->invit_place, 0, 0, 'L');
            $pdf->setXY(27, $line[8]);
            $pdf->Cell(250, 20, $out_site->objective, 0, 0, 'L');

            if($out_site->permit_start_date == $out_site->permit_end_date){
                $pdf->setXY(35, $line[9]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date)." - ", 0, 0, 'L');
            }else {
                $pdf->setXY(35, $line[9]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date)." - ", 0, 0, 'L');
                $pdf->setXY(70, $line[9]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
            }




            $x;$y=10;$license_plate='';
            switch ($out_site->travel_type) {
                case 1:
                    $x=37;
                    break;
                case 2:
                    $x=59;
                    break;
                case 3:
                    $x=94;
                    $license_plate=$out_site->license_plate;
                    break;
                case 4:
                    $x=38;
                    $y=18;
                    break;
            }
            $e=0;
            if($y==18){$e=1.8;}
            $pdf->setXY($x, $line[$y]+1-$e);
            $pdf->Cell(250, 20, '/', 0, 0, 'L');
            $pdf->setXY($x+55, $line[$y]+1);
            $pdf->Cell(250, 20,$license_plate , 0, 0, 'L');

// ลงชื่อ
            $pdf->setXY(95, $line[16]+3);
            $pdf->Cell(240, 0, $out_site->permit_user, 0, 0, 'P');
            $pdf->setXY(85, $line[17]+3);
            $pdf->Cell(240, 0, $out_site->permit_position, 0, 0, 'P');
           */
            break;
        case 2:
            $pdf->Cell(30, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'P');
            break;
    }

}


// Output the new PDF
$pdf->Output(); 