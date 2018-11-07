<?php
$this->load->library('Pdf');

// initiate FPDI
$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// get the page count
//$pageCount = $pdf->setSourceFile('Laboratory-Report.pdf');
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite1_template.pdf");
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
    $pdf->SetMargins(PDF_MARGIN_LEFT,40, PDF_MARGIN_RIGHT);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->setFontSubsetting(false);
    $pdf->SetTitle('ขออนุญาติไปราชการ_'.$out_site->date_permit);


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
            $pdf->setXY(50, $line[0]-23);
            $pdf->Cell(100, 20, '-', 0, 0, 'P');
            $pdf->setXY(50, $line[0]);
            $pdf->Cell(300, 20, to_thai_number_text($out_site->invit_name), 0, 0, 'P');
            $pdf->setXY(45, $line[1]);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->invit_number), 0, 0, 'L');
            $pdf->setXY(105, $line[1]);
            $pdf->Cell(250, 20, to_thai_date_full($out_site->invit_date), 0, 0, 'L');
            $pdf->setXY(28, $line[2]);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->invit_subject), 0, 0, 'L');
            $pdf->setXY(66, $line[3]);
            $pdf->Cell(250, 20, $out_site->invit_type, 0, 0, 'L');
            if($out_site->invit_start_date == $out_site->invit_end_date){
                $pdf->setXY(112, $line[3]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->invit_start_date), 0, 0, 'L');
            }else{
                $pdf->setXY(110, $line[3]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->invit_start_date), 0, 0, 'L');
                $pdf->setXY(146, $line[3]);
                $pdf->Cell(250, 20, " - ".to_thai_date_full($out_site->invit_end_date), 0, 0, 'L');
            }
            $pdf->setXY(25, $line[4]);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->invit_place), 0, 0, 'L');
            $pdf->setXY(138, $line[5]);
            $pdf->Cell(250, 20, $out_site->claim_type, 0, 0, 'L');
            $pdf->setXY(66, $line[6]);
            $pdf->Cell(250, 20, $member['0']->name, 0, 0, 'L');
            $pdf->setXY(132, $line[6]);
            $pdf->Cell(250, 20, $member['0']->position, 0, 0, 'L');
            $pdf->setXY(86, $line[7]);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->invit_place), 0, 0, 'L');
            $pdf->setXY(27, $line[8]);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->objective), 0, 0, 'L');

            if($out_site->permit_start_date == $out_site->permit_end_date){
                $pdf->setXY(35, $line[9]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date)." - ", 0, 0, 'L');
            }else {
                $pdf->setXY(35, $line[9]);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');
                $pdf->setXY(70, $line[9]);
                $pdf->Cell(250, 20, " - ".to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
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
            $pdf->Cell(240, 0, $member['0']->name, 0, 0, 'P');
            $pdf->setXY(85, $line[17]+3);
            $pdf->Cell(240, 0, $member['0']->position, 0, 0, 'P');
            break;
        case 2:
            $pdf->Cell(30, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'P');
            break;
    }

}


// Output the new PDF
$pdf->Output('outsite_'.$out_site->date_permit);