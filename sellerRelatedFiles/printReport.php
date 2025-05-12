<?php
// Include FPDF library (download into fpdf/ directory under project root)
require('fpdf/fpdf.php');

require '../database.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

// Fetch total sales for today, this month, and this year
$queries = [
    'daily'   => "SELECT COALESCE(SUM(totalAmount), 0) AS total FROM `Order` WHERE DATE(orderDate) = CURDATE()",
    'monthly' => "SELECT COALESCE(SUM(totalAmount), 0) AS total FROM `Order` WHERE YEAR(orderDate)=YEAR(CURDATE()) AND MONTH(orderDate)=MONTH(CURDATE())",
    'yearly'  => "SELECT COALESCE(SUM(totalAmount), 0) AS total FROM `Order` WHERE YEAR(orderDate)=YEAR(CURDATE())",
];
$totals = [];
foreach ($queries as $key => $sql) {
    $stmt = $pdo->query($sql);
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    $totals[$key] = number_format($row['total'], 2);
}

// Create PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Sales Report', 0, 1, 'C');
$pdf->Ln(5);

// Body: totals
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 8, 'Total Sales Today:', 0, 0);
$pdf->Cell(0, 8, '$' . $totals['daily'], 0, 1);
$pdf->Cell(80, 8, 'Total Sales This Month:', 0, 0);
$pdf->Cell(0, 8, '$' . $totals['monthly'], 0, 1);
$pdf->Cell(80, 8, 'Total Sales This Year:', 0, 0);
$pdf->Cell(0, 8, '$' . $totals['yearly'], 0, 1);

// Output PDF for download with date suffix
$filename = 'sales_report_' . date('Ymd') . '.pdf';
$pdf->Output('D', $filename);
exit;
?>
