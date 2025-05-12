<?php
    require('fpdf/fpdf.php');      // adjust path if needed

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'Hello, FPDF on XAMPP!',0,1,'C');
    $pdf->Output();
?>