<?php
require('libs/fpdf17/fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'!!!!!!!!Hola, Mundo!');
$pdf->Output();
?>
