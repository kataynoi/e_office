<?php
//$this->load->library('Pdf');
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

$pdf = new FPDI(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(FALSE);
$pdf->setPrintFooter(FALSE);
$pageCount = $pdf->setSourceFile(dirname(__FILE__)."/used_car.pdf");
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
    $pdf->SetTitle('ขออนุญาติใช้รถยนต์ส่วนกลาง_'.$out_site->date_permit);



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
            $pdf->setXY(150, $line[4]+2);
            $pdf->Cell(0, 0, to_thai_date_full($out_site->date_permit), 0, 0, 'L');
            $pdf->setXY(63, $line[6]+2.5);
            $pdf->Cell(0, 0, $member['0']->prename.$member['0']->name."  ตำแหน่ง".to_thai_number_text($member['0']->position), 0, 0, 'L');

            $pdf->setXY(48, $line[7]+2.5);
            $pdf->Cell(0, 0, $group_name, 0, 0, 'L');


            $pdf->setXY(25, $line[9]+3);
            $pdf->Cell(0, 0, to_thai_number_text($out_site->objective), 0, 0, 'L');
            $pdf->setXY(26, $line[10]+3);
            $pdf->Cell(0, 0, "ณ ".to_thai_number_text($out_site->invit_place), 0, 0, 'L');

            $pdf->setXY(55, $line[11]+3);
            $pdf->Cell(0, 0, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');

            $pdf->setXY(35, $line[12]+3);
            $pdf->Cell(0, 0, to_thai_date_full($out_site->permit_end_date), 0, 0, 'L');
            $pdf->setXY(70, $line[13]+5);
            $pdf->Cell(0, 0, to_thai_number(sizeof($car)), 0, 0, 'L');
            $n=1;
            foreach($car as $m){
                //$line=13+$n;
                $pdf->setXY(65, $line[14+$n]-1);
                $pdf->Cell(0, 0, to_thai_number_text($m->licente_plate), 0, 1, 'L');
                $pdf->setXY(106, $line[14+$n]-1);
                $pdf->Cell(0, 0, $m->driver, 0, 1, 'L');
                $pdf->setXY(49, $line[15+$n]-1);
                $pdf->Cell(0, 0, $m->control_car, 0, 1, 'L');
                $n=$n+2;

            }

            $pdf->setXY(120, $line[28]);
            $pdf->Cell(0, 0, $member['0']->prename.$member['0']->name, 0, 0, 'C');

            break;
        case 2:

            $perline=7.6;
            $startline=2;
            $line[]= array();
            for($i=0; $i<=35; $i++){
                $line[$i]=$startline+($perline*$i);
            }
            $n=1;
            $addpage=0;
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
            $pdf->Cell(0, 0, "ณ ".to_thai_number_text($out_site->invit_place), 0, 0, 'C');


            foreach($member as $m){
                if($n==30){
                    $addpage=1;
                    $pageCount = $pdf->setSourceFile(dirname(__FILE__)."/addperson.pdf");
                    $templateId = $pdf->importPage(1);
                    //$size = $pdf->getTemplateSize($templateId);
                    $pdf->AddPage('P');
                    $pdf->useTemplate($templateId);


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
                    $pdf->Cell(0, 0, "ณ ".to_thai_number_text($out_site->invit_place), 0, 0, 'C');
                    $n=1;
                }
                $pdf->setXY(28, $line[4+$n]+7);
                if($addpage==1){
                    $pdf->Cell(20, 0, to_thai_number($n+29), 0, 1, 'L');
                }else{
                    $pdf->Cell(20, 0, to_thai_number($n), 0, 1, 'L');
                }
                $pdf->setXY(45, $line[4+$n]+7);
                $pdf->Cell(0, 0, $m->prename.$m->name, 0, 1, 'L');
                $pdf->setXY(105, $line[4+$n]+7);
                $pdf->Cell(0, 0, to_thai_number_text($m->position), 0, 1, 'L');

                $n++;

            }
            break;
    }
}
// Output the new PDF
$pdf->Output('car_'.$out_site->date_permit);