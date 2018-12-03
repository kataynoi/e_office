<?php
$this->load->library('Pdf');

// initiate FPDI
$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
// get the page count
//$pageCount = $pdf->setSourceFile('Laboratory-Report.pdf');
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite3_template.pdf");
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
            $pdf->setXY(24, $line[0]-23);
            $pdf->Cell(300, 20, to_thai_number_text($book_number)."/", 0, 0, 'P');
            $pdf->setXY(110, $line[0]-23);
            $pdf->Cell(300, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'P');
            $pdf->setXY(50, $line[0]-23);
            $pdf->Cell(100, 20, '-', 0, 0, 'P');
            $pdf->setXY(52, $line[0]);
            $pdf->Cell(300, 20, to_thai_number_text($out_site->invit_name), 0, 0, 'P');
            $pdf->setXY(43, $line[1]);
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
            /* บิกค่าใช้จ่ายจากไหน */
            if($out_site->claim_type == 4){
                $pdf->setXY(28, $line[5]);
                $pdf->Cell(250, 20, $out_site->claim_type_name, 0, 0, 'L');
            }else if($out_site->claim_type == 5){
                $pdf->setXY(28, $line[5]);
                $pdf->Cell(250, 20, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_cause, 0, 0, 'L');
            }else{
                $pdf->setXY(28, $line[5]);
                $pdf->Cell(250, 20, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_type_name, 0, 0, 'L');
            }


            $pdf->setXY(57, $line[6]+1);
            $pdf->Cell(250, 20, $member['0']->prename.$member['0']->name, 0, 0, 'L');
            $pdf->setXY(124, $line[6]+1);
            $pdf->Cell(245, 20, $member['0']->position, 0, 0, 'L');
            $pdf->setXY(20, $line[8]+1);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->invit_place), 0, 0, 'L');
            $pdf->setXY(27, $line[9]+1);
            $pdf->Cell(250, 20, to_thai_number_text($out_site->objective), 0, 0, 'L');

            if($out_site->permit_start_date == $out_site->permit_end_date){
                $pdf->setXY(35, $line[10]+1);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');
            }else {
                $pdf->setXY(35, $line[10]+1);
                $pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');
                $pdf->setXY(70, $line[10]+1);
                $pdf->Cell(250, 20, " - ".to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
            }
            $s=(string)$out_site->travel_type_name;
            if($out_site->travel_type == 6){
                $pdf->setXY(55, $line[11]+1);
                //$pdf->Cell(250, 20, $out_site->travel_type_name, 0, 0, 'L');
                $pdf->writeHTML($s);
            }elseif($out_site->travel_type == 3){
                $pdf->setXY(55, $line[11]+1);
                $pdf->Cell(250, 20, $out_site->travel_type_name, 0, 0, 'L');
                $pdf->setXY(77, $line[11]+1);
                $pdf->Cell(250, 20, " หมายเลขทะเบียน ".to_thai_number_text($out_site->license_plate), 0, 0, 'L');
            }else{
                $pdf->setXY(55, $line[11]+1);
                $pdf->Cell(250, 20, $out_site->travel_type_name, 0, 0, 'L');
            }

            //$pdf->writeHTML($out_site->travel_type_name);

// ลงชื่อ
            $pdf->setXY(0, $line[17]+3);
            $pdf->Cell(240, 0, $member['0']->prename.$member['0']->name, 0, 0, 'C');
            $pdf->setXY(0, $line[18]+3);
            $pdf->Cell(240, 0, $member['0']->position, 0, 0, 'C');
            break;
        case 2:

            $perline=7.6;
            $startline=2;
            $line[]= array();
            for($i=0; $i<=35; $i++){
                $line[$i]=$startline+($perline*$i);
            }
            $n=1;
            $pdf->setXY(0, $line[2]);
            $pdf->Cell(0, 0, "รายชื่อผู้".to_thai_number_text($out_site->objective), 0, 0, 'C');
            if($out_site->permit_start_date == $out_site->permit_end_date){
                $end_date = '';
            }else {
                $end_date =" - ".to_thai_date_full($out_site->permit_end_date);
            }
            $pdf->setXY(0, $line[3]);
            $pdf->Cell(0, 0, "วันที่ ".to_thai_date_full($out_site->permit_start_date).$end_date, 0, 0, 'C');
            $pdf->setXY(0, $line[4]);
            $pdf->Cell(0, 0, "ณ ".$out_site->invit_place, 0, 0, 'C');


            foreach($member as $m){
                //$line=13+$n;
                    $pdf->setXY(22, $line[5+$n]);
                    $pdf->Cell(20, 0, to_thai_number($n), 0, 1, 'L');
                    $pdf->setXY(35, $line[5+$n]);
                    $pdf->Cell(20, 0, $m->prename.$m->name, 0, 1, 'L');
                    $pdf->setXY(95, $line[5+$n]);
                    $pdf->Cell(20, 0, to_thai_number_text($m->position), 0, 1, 'L');

                $n++;
            }
            break;
    }

}


// Output the new PDF
$pdf->Output('outsite_'.$out_site->date_permit);