<?php
$this->load->library('Pdf');

class MyPDF extends Pdf
{
    /**
     * "Remembers" the template id of the imported page
     */
    var $_tplIdx;
    var $template=1;

    /**
     * Draw an imported PDF logo on every page
     */
    function Header()
    {
        $file = dirname(__FILE__)."/outsite7_template.pdf";
        if (is_null($this->_tplIdx)) {
            $this->setSourceFile($file);
            $this->_tplIdx = $this->importPage(2);
        }
        $specs = $this->getTemplateSize($this->_tplIdx);
        $size = $this->useTemplate($this->_tplIdx, 10);
    }

    function Footer()
    {
        // emtpy method body
    }
}

// initiate PDF
$pdf = new MyPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT,40, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(true, 20);
$pdf->setFontSubsetting(false);

// add a page
// อนุญาตให้สามารถกำหนดรุปแบบ ฟอนท์ย่อยเพิมเติมในหน้าใช้งานได้
$pdf->setFontSubsetting(true);

// กำหนด ฟอนท์
$pdf->SetFont('thsarabun', '', 16, '', true);
$pdf->AddPage();
// $pdf->SetFont('freeserif', '', 12);
$perline=6.3;
$startline=54.7;
$line[]= array();
for($i=0; $i<=35; $i++){
    $line[$i]=$startline+($perline*$i);
}

$pdf->setXY(120, $line[0]-23);
$pdf->Cell(300, 20, to_thai_date_full($out_site->date_permit), 0, 0, 'L');
$pdf->setXY(65, $line[0]-23);
$pdf->Cell(300, 20, to_thai_number($out_site->id), 0, 0, 'L');
$pdf->setXY(65, $line[0]);
$pdf->Cell(300, 20, $out_site->invit_name, 0, 0, 'L');
$pdf->setXY(50, $line[1]);
$pdf->Cell(250, 20, $out_site->invit_number, 0, 0, 'L');
$pdf->setXY(120, $line[1]);
$pdf->Cell(250, 20, to_thai_date_full($out_site->invit_date), 0, 0, 'L');
$pdf->setXY(40, $line[2]);
$pdf->Cell(250, 20, $out_site->invit_subject, 0, 0, 'L');
$pdf->setXY(80, $line[3]);
$pdf->Cell(250, 20, $out_site->invit_type, 0, 0, 'L');
$pdf->setXY(130, $line[3]);
$pdf->Cell(250, 20, to_thai_date_full($out_site->invit_start_date), 0, 0, 'L');
$pdf->setXY(35, $line[4]);
$pdf->Cell(250, 20, $out_site->invit_place, 0, 0, 'L');
$pdf->setXY(130, $line[5]);
$pdf->Cell(250, 20, $out_site->claim_type, 0, 0, 'L');
$pdf->setXY(66, $line[6]);
$pdf->Cell(250, 20, $out_site->permit_user, 0, 0, 'L');
$pdf->setXY(132, $line[6]);
$pdf->Cell(250, 20, $out_site->permit_position, 0, 0, 'L');
$pdf->setXY(86, $line[7]);
$pdf->Cell(250, 20, $out_site->invit_place, 0, 0, 'L');
$pdf->setXY(36, $line[8]);
$pdf->Cell(250, 20, $out_site->objective, 0, 0, 'L');
$pdf->setXY(43, $line[9]);
$pdf->Cell(250, 20, to_thai_date_full($out_site->permit_start_date), 0, 0, 'L');

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
$pdf->setXY(5, $line[16]+3);
$pdf->Cell(240, 0, $out_site->permit_user, 0, 0, 'C');
$pdf->setXY(5, $line[17]+3);
$pdf->Cell(240, 0, $out_site->permit_position, 0, 0, 'C');

// end

/*
$data = array();
$data[0] = array('name'=>'ด.ช.ใจดี มีสุข', 'score1' => 1, 'score2' => 1, 'score3' => 1);
$data[1] = array('name'=>'ด.ญ.อารียา พาใจ', 'score1' => 0, 'score2' => 1, 'score3' => 3);
$data[2] = array('name'=>'ด.ญ.มานี มีนา', 'score1' => 3, 'score2' => 1, 'score3' => 2);
$data[3] = array('name'=>'ด.ช.มานพ พบพาน', 'score1' => 1, 'score2' => 0, 'score3' => 3);

$i=0;
$x=35;
$y=80;
$pdf->setCellPaddings(0, 2, 0, 0);
$pdf->setCellMargins(0, 0, 0, 0);
foreach ($data as $row){
    $i++;

    if($row['score1'] > 0 && $row['score2'] > 0 && $row['score3'] > 0){
        $ok = '/';
        $fail = '';
    }else{
        $ok = '';
        $fail = '/';
    }
    $pdf->SetXY($x,$y);

    $pdf->MultiCell(20, 9, to_thai_number($i), 0, 'C', 0, 0);
    $pdf->MultiCell(55, 9, $row['name'], 0, 'L', 0, 0);
    $pdf->MultiCell(10, 9, $row['score1'], 0,  'C', 0, 0);
    $pdf->MultiCell(10, 9, $row['score2'], 0,  'C', 0, 0);
    $pdf->MultiCell(10, 9, $row['score3'], 0,  'C', 0, 0);
    $pdf->MultiCell(20, 9, $row['score1']+$row['score2']+$row['score3'], 0, 'C', 0, 0);
    $pdf->MultiCell(15, 9, $ok, 0, 'C', 0, 0);
    $pdf->MultiCell(15, 9, $fail, 0, 'C', 0, 0);

    $y += 8.7;
}
*/


$pdf->Output();
?>