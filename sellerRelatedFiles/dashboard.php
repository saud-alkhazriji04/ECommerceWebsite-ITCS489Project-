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


    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f9f9f9; color: #333; }
    header { display: flex; justify-content: space-between; align-items: center;
             padding: 1rem; background: #fff; border-bottom: 1px solid #ddd; }
    .logo { font-size: 1.5rem; font-weight: bold; color: #f57c00; }
    .logout-btn { background: #444; color: #fff; border: none; padding: .5rem 1rem;
                  border-radius: 20px; cursor: pointer; }
    .container { display: flex; min-height: 100vh; }
    aside { width: 200px; background: #fff; border-right: 1px solid #ddd; }
    aside nav a { display: flex; align-items: center; padding: .75rem 1rem;
                 text-decoration: none; color: #333; transition: background .2s; }
    aside nav a.active, aside nav a:hover { background: #ffe5d0; color: #f57c00; }
    aside nav a span { margin-right: .5rem; font-size: 1.2rem; }
    main { flex: 1; padding: 2rem; }

    .orders-list { list-style: none; }
    .order-item { display: flex; justify-content: space-between; background: #fff;
                  padding: 1rem; margin-bottom: .5rem; border-radius: 4px;
                  border: 1px solid #eee; }
    .order-detail { display: flex; }
    .order-icon { font-size: 2rem; color: #f57c00; margin-right: 1rem; }
    .order-info { display: flex; flex-direction: column; justify-content: space-between; }
    .products { font-weight: 500; }
    .meta { font-size: .9rem; color: #666; line-height: 1.4; }
    .right-info { text-align: right; display: flex; flex-direction: column;
                  justify-content: space-between; }
    .amount { font-weight: bold; }


    body { font-family: Arial, sans-serif; }
    .card { display: inline-block; width: 30%; margin-right: 2%; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    .card h3 { margin: 0 0 10px; }
    #chartContainer { width: 100%; max-width: 600px; margin-top: 40px; }
    #printReport { margin-top: 20px; padding: 10px 20px; border: none; border-radius: 5px; background: #007bff; color: #fff; cursor: pointer; }
  </style>
</head>
<body>
  <header>
    <div class="logo">eCommerce - Seller Page</div>
    <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
  </header>

  <div class="container">

    <aside>
      <nav>
        <a href="add_product.php"><span>➕</span> Add Product</a>
        <a href="product_list_page.php"><span>📋</span> Product List</a>
        <a href="orders_page.php"><span>✅</span> Orders</a>
        <a href="dashboard.php" class="active"><span>📊</span> DashBoard</a>
      </nav>
    </aside>

    <main>
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
    </main>

  </div>


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