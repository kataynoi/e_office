<?php
//$this->load->library('Pdf');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
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
    //$pdf->SetMargins(PDF_MARGIN_LEFT,40, PDF_MARGIN_RIGHT);
    $pdf->SetMargins(20,40, 20);
    $pdf->SetAutoPageBreak(true, 20);
    $pdf->setFontSubsetting(false);
    $pdf->SetTitle('ขออนุญาตไปราชการ_'.$out_site->date_permit);



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
            $pdf->Cell(0, 0, to_thai_number_text($book_number)."/ -", 0, 0, 'L');
            $pdf->setXY(110, $line[6]);
            $pdf->Cell(0, 0, to_thai_date_full($out_site->date_permit), 0, 0, 'L');

            $pdf->setXY(52, $line[10]+1.6);
            $pdf->Cell(300, 0, to_thai_number_text($out_site->invit_name), 0, 0, 'L');
            $pdf->setXY(40, $line[11]+1.6);
            $pdf->Cell(250, 0, to_thai_number_text($out_site->invit_number), 0, 0, 'L');


            $pdf->setXY(105, $line[11]+1.6);
            $pdf->Cell(250, 0, to_thai_date_full($out_site->invit_date), 0, 0, 'L');
            $pdf->setXY(27, $line[12]+1.65);
            $pdf->writeHTML("<div>เรื่อง ".to_thai_number_text($out_site->invit_subject)."</div>");
            $pdf->setXY(66, $line[14]+1.65);
            $pdf->Cell(250, 0, $out_site->invit_type, 0, 0, 'L');
            if($out_site->invit_start_date == $out_site->invit_end_date){
                $pdf->setXY(112, $line[14]+1.65);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->invit_start_date), 0, 0, 'L');
            }else{
                $pdf->setXY(112, $line[14]+1.65);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->invit_start_date)." - ".to_thai_date_full($out_site->invit_end_date), 0, 0, 'L');
            }
            $pdf->setXY(23, $line[15]+1.65);
            $pdf->Cell(0, 0, to_thai_number_text($out_site->invit_place), 0, 0, 'L');

            /*ส่วนที่ 2 */
            $pdf->setXY(57, $line[16]+1.7);
            $pdf->Cell(0, 0, $member['0']->prename.$member['0']->name."  ตำแหน่ง".to_thai_number_text($member['0']->position), 0, 0, 'L');

            $pdf->setXY(80, $line[17]+1.8);
            $pdf->Cell(250, 0, to_thai_number_text($out_site->invit_place), 0, 0, 'L');
            $pdf->setXY(26, $line[18]+1.9);
            $pdf->writeHTML("<div>เพื่อ ".to_thai_number_text($out_site->objective)."</div>");

            if($out_site->permit_start_date == $out_site->permit_end_date){
                $pdf->setXY(32, $line[20]+1.9);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');
            }else {
                $pdf->setXY(32, $line[20]+1.9);
                $pdf->Cell(250, 0, to_thai_date_full($out_site->permit_start_date)." - ".to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
            }
            $s=(string)$out_site->travel_type_name;
            if($out_site->travel_type == 3){
                $pdf->setXY(54, $line[21]+2);
                $pdf->Cell(250, 0, $out_site->travel_type_name." หมายเลขทะเบียน ".to_thai_number_text($out_site->license_plate), 0, 0, 'L');
            }else{
                $pdf->setXY(54, $line[21]+2);
                $pdf->Cell(250, 0, $out_site->travel_type_name, 0, 0, 'L');
            }

            /* บิกค่าใช้จ่ายจากไหน */
            if($out_site->claim_type == 4){
                $pdf->setXY(25, $line[22]+1.8);
                $pdf->Cell(250, 0, $out_site->claim_type_name, 0, 0, 'L');
            }else if($out_site->claim_type == 5){
                $pdf->setXY(25, $line[22]+1.8);
                $pdf->Cell(0, 0, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_cause, 0, 0, 'L');
            }else{
                $pdf->setXY(25, $line[22]+1.8);
                $pdf->Cell(0, 0, 'ขอเบิกค่าใช้จ่ายเดินทางไปราชการจาก'.$out_site->claim_type_name, 0, 0, 'L');
            }


// ลงชื่อ
            $pdf->setXY(0, $line[26]+6.8);
            $pdf->Cell(240, 0, $member['0']->prename.$member['0']->name, 0, 0, 'C');
            $pdf->setXY(0, $line[27]+6.8);
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