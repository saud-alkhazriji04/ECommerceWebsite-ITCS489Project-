<?php
// admin_dashboard.php: Displays sales dashboard and report button
require('fpdf/fpdf.php'); // For FPDF (PDF report)

// // Database connection
// $host = 'localhost';
// $db   = 'your_database';
// $user = 'db_user';
// $pass = 'db_pass';
// $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
// try {
//     $pdo = new PDO($dsn, $user, $pass, [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     ]);
// } catch (PDOException $e) {
//     die("Database connection failed: " . $e->getMessage());
// }

require '../database.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

// Fetch sales totals
$queries = [
    'daily'   => "SELECT COALESCE(SUM(totalAmount),0) AS total FROM `Order` WHERE DATE(orderDate) = CURDATE()",
    'monthly' => "SELECT COALESCE(SUM(totalAmount),0) AS total FROM `Order` WHERE YEAR(orderDate)=YEAR(CURDATE()) AND MONTH(orderDate)=MONTH(CURDATE())",
    'yearly'  => "SELECT COALESCE(SUM(totalAmount),0) AS total FROM `Order` WHERE YEAR(orderDate)=YEAR(CURDATE())"
];
$totals = [];
foreach ($queries as $key => $sql) {
    $stmt = $pdo->query($sql);
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
    $totals[$key] = (float)$row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sales Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .card { display: inline-block; width: 30%; margin-right: 2%; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .card h3 { margin: 0 0 10px; }
    #chartContainer { width: 100%; max-width: 600px; margin-top: 40px; }
    #printReport { margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; background: #007bff; color: #fff; cursor: pointer; }
  </style>
</head>
<body>
  <h1>Sales Dashboard</h1>

  <div class="card">
    <h3>Today</h3>
    <p style="font-size: 24px;">$<?php echo number_format($totals['daily'],2); ?></p>
  </div>
  <div class="card">
    <h3>This Month</h3>
    <p style="font-size: 24px;">$<?php echo number_format($totals['monthly'],2); ?></p>
  </div>
  <div class="card">
    <h3>This Year</h3>
    <p style="font-size: 24px;">$<?php echo number_format($totals['yearly'],2); ?></p>
  </div>

  <div id="chartContainer">
    <canvas id="salesChart"></canvas>
  </div>

  <button id="printReport">Print Sales Report</button>

  <script>
    // Chart.js bar chart for daily, monthly, yearly totals
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Today', 'This Month', 'This Year'],
        datasets: [{
          label: 'Sales Amount',
          data: [<?php echo $totals['daily']; ?>, <?php echo $totals['monthly']; ?>, <?php echo $totals['yearly']; ?>],
          backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)'],
          borderColor: ['rgba(54, 162, 235, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        scales: { y: { beginAtZero: true } }
      }
    });

    // Print report on button click
    document.getElementById('printReport').addEventListener('click', function() {
      window.open('printReport.php', '_blank');
    });
  </script>
</body>
</html>