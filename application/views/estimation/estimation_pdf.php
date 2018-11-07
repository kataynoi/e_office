<?php
$this->load->library('Pdf');

class MyPDF extends Pdf
{
    /**
     * "Remembers" the template id of the imported page
     */
    var $_tplIdx;

    /**
     * Draw an imported PDF logo on every page
     */
    function Header()
    {
        $file = dirname(__FILE__)."/PdfDocument.pdf";
        if (is_null($this->_tplIdx)) {
            $this->setSourceFile($file);
            $this->_tplIdx = $this->importPage(1);
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(true, 20);
$pdf->setFontSubsetting(false);

// add a page
// อนุญาตให้สามารถกำหนดรุปแบบ ฟอนท์ย่อยเพิมเติมในหน้าใช้งานได้
$pdf->setFontSubsetting(true);

// กำหนด ฟอนท์
$pdf->SetFont('thsarabun', '', 16, '', true);
$pdf->AddPage();
// $pdf->SetFont('freeserif', '', 12);

$data = array();
$data[0] = array('name'=>'ด.ช.ใจดี มีสุข', 'score1' => 1, 'score2' => 1, 'score3' => 1);
$data[1] = array('name'=>'ด.ญ.อารียา พาใจ', 'score1' => 0, 'score2' => 1, 'score3' => 3);
$data[2] = array('name'=>'ด.ญ.มานี มีนา', 'score1' => 3, 'score2' => 1, 'score3' => 2);
$data[3] = array('name'=>'ด.ช.มานพ พบพาน', 'score1' => 1, 'score2' => 0, 'score3' => 3);
$data[4] = array('name'=>'ด.ช.หาญกล้า ชาญสมร', 'score1' => 2, 'score2' => 3, 'score3' => 1);
$data[5] = array('name'=>'ด.ช.ใจดี มีสุข', 'score1' => 1, 'score2' => 1, 'score3' => 1);
$data[6] = array('name'=>'ด.ญ.อารียา พาใจ', 'score1' => 2, 'score2' => 1, 'score3' => 3);
$data[7] = array('name'=>'ด.ญ.มานี มีนา', 'score1' => 0, 'score2' => 1, 'score3' => 2);
$data[8] = array('name'=>'ด.ช.มานพ พบพาน', 'score1' => 1, 'score2' => 0, 'score3' => 3);

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

    $pdf->MultiCell(20, 9, $i, 0, 'C', 0, 0);
    $pdf->MultiCell(55, 9, $row['name'], 0, 'L', 0, 0);
    $pdf->MultiCell(10, 9, $row['score1'], 0,  'C', 0, 0);
    $pdf->MultiCell(10, 9, $row['score2'], 0,  'C', 0, 0);
    $pdf->MultiCell(10, 9, $row['score3'], 0,  'C', 0, 0);
    $pdf->MultiCell(20, 9, $row['score1']+$row['score2']+$row['score3'], 0, 'C', 0, 0);
    $pdf->MultiCell(15, 9, $ok, 0, 'C', 0, 0);
    $pdf->MultiCell(15, 9, $fail, 0, 'C', 0, 0);

    $y += 8.7;
}

//foot data
$pdf->setXY(98, 251);
$pdf->Cell(56, 8, 'อ.อารีย์   ใจดี', 0, 0, 'C');

$pdf->setXY(109, 259);
$date = date('d') . '            '. date('m') . '           ' . (date('Y')+543);
$pdf->Cell(56, 8, $date, 0, 0, 'L');

$pdf->Output();
?>