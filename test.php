<?

require_once('application/third_party/fpdf/fpdf.php');
require_once('fpdi2/src/autoload.php');

// initiate FPDI
$pdf = new Fpdi();

// get the page count
$pageCount = $pdf->setSourceFile('Laboratory-Report.pdf');
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
// import a page
$templateId = $pdf->importPage($pageNo);

$pdf->AddPage();
// use the imported page and adjust the page size
$pdf->useTemplate($templateId, ['adjustPageSize' => true]);

$pdf->SetFont('Helvetica');
$pdf->SetXY(5, 5);
$pdf->Write(8, 'A complete document imported with FPDI');
}

// Output the new PDF
$pdf->Output();
?>