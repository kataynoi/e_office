<?php
//$this->load->library('Pdf');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/outsite5_template.pdf");
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
    $pdf->SetMargins(20,40, PDF_MARGIN_RIGHT);
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
    $startline=0;
    $line[]= array();
    for($i=0; $i<=35; $i++){
        $line[$i]=$startline+($perline*$i);
    }
    switch  ($pageNo){
        case 1:
            /*ส่วนหัว*/
            $pdf->setXY(25, $line[6]);
            $pdf->Cell(0, 0, to_thai_number_text($book_number)."/", 0, 0, 'L');
            $pdf->setXY(110, $line[6]);
            $pdf->Cell(0, 0, to_thai_date_full($out_site->date_permit), 0, 0, 'L');


            /* ไม่มีหนังสือเชิญ */
            $pdf->setXY(0, $line[10]);
            $pdf->writeHTML("<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ".to_thai_number_text($out_site->detail_no_invit,1)."</div>");

            /*ส่วนที่ 2 */
            $pdf->setXY(57, $line[13]+1.7);
            $pdf->Cell(0, 0, $member['0']->prename.$member['0']->name."  ตำแหน่ง".to_thai_number_text($member['0']->position), 0, 0, 'L');

            $n=0;
            foreach($member as $m){
                if($n!=0){
                    $pdf->setXY(38, $line[13+$n]+1.85);
                    $pdf->Cell(0, 0, to_thai_number($n).". ".$m->prename.$m->name, 0, 0, 'L');
                    $pdf->setXY(90, $line[13+$n]+1.85);
                    $pdf->Cell(0, 0, "ตำแหน่ง".to_thai_number_text($m->position), 0, 0, 'L');
                }
                $n++;
            }
            $pdf->setXY(80, $line[17]+1.8);
            $pdf->Cell(250, 0, to_thai_number_text($out_site->invit_place), 0, 0, 'L');
            $pdf->setXY(26, $line[18]+1.9);
            $pdf->Cell(250, 0, to_thai_number_text($out_site->objective), 0, 0, 'L');

            if($out_site->permit_start_date == $out_site->permit_end_date){
                $pdf->setXY(32, $line[19]+2);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');
            }else {
                $pdf->setXY(32, $line[19]+2);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->permit_start_date)." - ".to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
            }
            $s=(string)$out_site->travel_type_name;
            if($out_site->travel_type == 3){
                $pdf->setXY(54, $line[20]+2.2);
                $pdf->Cell(250, 0, $out_site->travel_type_name." หมายเลขทะเบียน ".to_thai_number_text($out_site->license_plate), 0, 0, 'L');
            }else{
                $pdf->setXY(54, $line[20]+2.2);
                $pdf->Cell(250, 0, $out_site->travel_type_name, 0, 0, 'L');
            }
            /* บิกค่าใช้จ่ายจากไหน */
            if($out_site->claim_type == 4){
                $pdf->setXY(25, $line[21]+1.65);
                $pdf->Cell(250, 0, $out_site->claim_type_name, 0, 0, 'L');
            }else if($out_site->claim_type == 5){
                $pdf->setXY(25, $line[21]+1.65);
                $pdf->Cell(0, 0, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_cause, 0, 0, 'L');
            }else{
                $pdf->setXY(25, $line[21]+1.65);
                $pdf->Cell(0, 0, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_type_name, 0, 0, 'L');
            }
            //$pdf->writeHTML($out_site->travel_type_name);

// ลงชื่อ
            $pdf->setXY(0, $line[25]+7);
            $pdf->Cell(240, 0, $member['0']->prename.$member['0']->name, 0, 0, 'C');
            $pdf->setXY(0, $line[26]+7);
            $pdf->Cell(240, 0, $member['0']->position, 0, 0, 'C');
            break;
        case 2:
            $pdf->Cell(30, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'P');
            break;
    }

}


// Output the new PDF
$pdf->setPrintHeader(true);
$pdf->Output('outsite_'.$out_site->date_permit);