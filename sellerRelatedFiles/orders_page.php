<?php
// File: orders.php
require_once '../database.php'; // sets up $pdo via PDO
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
// Adjusted to match your schema
$sql = "
SELECT
  o.orderID,
  GROUP_CONCAT(CONCAT(p.productName, ' x ', op.quantity) SEPARATOR ', ') AS products,
  SUM(op.unitPrice * op.quantity) AS totalAmount,
  'COD' AS paymentMethod,
  o.orderDate,
  pay.paymentStatus,
  c.name AS fullName,
  CONCAT(c.block, ', ', c.road, ', ', c.houseNumber) AS address,
  c.phoneNumber AS phone
FROM `Order` o
JOIN OrderProduct op ON o.orderID = op.orderID
JOIN Product p ON op.productID = p.productID
JOIN Customer c ON o.customerID = c.customerID
LEFT JOIN Payment pay ON o.orderID = pay.orderID
GROUP BY o.orderID
ORDER BY o.orderDate DESC
";
$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller - Orders</title>
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
        <a href="orders_page.php" class="active"><span>✅</span> Orders</a>
        <a href="dashboard.php"><span>📊</span> DashBoard</a>
      </nav>
    </aside>

    <main>
      <h1>Orders</h1>
      <ul class="orders-list">
        <?php foreach ($orders as $o): ?>
          <li class="order-item">
            <div class="order-detail">
              <div class="order-icon">📦</div>
              <div class="order-info">
                <div class="products"><?= htmlspecialchars($o->products, ENT_QUOTES) ?></div>
                <div class="meta">Items: <?= substr_count($o->products, ',') + 1 ?></div>
                <div class="meta">
                  <?= htmlspecialchars($o->fullName, ENT_QUOTES) ?><br>
                  <?= nl2br(htmlspecialchars($o->address, ENT_QUOTES)) ?><br>
                  <?= htmlspecialchars($o->phone, ENT_QUOTES) ?>
                </div>
              </div>
            </div>
            <div class="right-info">
              <div class="amount">$<?= number_format($o->totalAmount, 2) ?></div>
              <div class="meta">
                Method: <?= htmlspecialchars($o->paymentMethod, ENT_QUOTES) ?><br>
                Date: <?= date('n/j/Y', strtotime($o->orderDate)) ?><br>
                Payment: <?= htmlspecialchars($o->paymentStatus, ENT_QUOTES) ?>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </main>
  </div>
</body>
</html>