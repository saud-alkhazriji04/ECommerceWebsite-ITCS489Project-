



<?php
// order_success.php
// Expects $order (assoc) and $products (array) from OrderController::success()

?>
<!-- <div class="container order-success">
  <div class="status-banner">
    <h1>🎉 Thank you for your purchase!</h1>
    <p>Your order #<strong><?= htmlspecialchars($order['orderID']) ?></strong> was placed on <strong><?= htmlspecialchars($order['orderDate']) ?></strong>.</p>
  </div>

  <section class="order-details">
    <h2>Order Details</h2>
    <table class="order-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Qty</th>
          <th>Unit Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($products as $p): ?>
        <tr>
          <td><?= htmlspecialchars($p['productName']) ?></td>
          <td><?= $p['quantity'] ?></td>
          <td>$<?= number_format($p['unitPrice'],2) ?></td>
          <td>$<?= number_format($p['unitPrice'] * $p['quantity'],2) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="total-label">Total</td>
          <td class="total-value">$<?= number_format($order['totalAmount'],2) ?></td>
        </tr>
      </tfoot>
    </table>
  </section>

  <div class="actions">
    <a href="products" class="btn-buy">Continue Shopping</a>
  </div>
</div> -->



<?php
// app/views/order_success.php
// Assumes $order and $products are already defined

// Base URL for Continue Shopping
$baseURL = '/eComWebSite/TestMVC/Public';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f7fafc; margin:0; padding:0; }
    header { background: #fff; padding:1rem 2rem; box-shadow:0 2px 4px rgba(0,0,0,0.1); }
    header h1 { margin:0; color:#ff6600; }
    main { max-width: 900px; margin:2rem auto; background:#fff; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.05); overflow:hidden;}
    .status-banner { padding:2rem; text-align:center; background:#edf2f7; }
    .status-banner h1 { margin-bottom:.5rem; font-size:1.75rem; color:#2d3748; }
    .status-banner p { color:#4a5568; }
    .order-details { padding:1rem 2rem; }
    .order-details h2 { margin-bottom:1rem; color:#2d3748; }
    table { width:100%; border-collapse:collapse; }
    th, td { padding:.75rem; border-bottom:1px solid #eee; text-align:left; }
    tfoot td { font-weight:600; }
    .actions { padding:2rem; text-align:center; }
    .btn { display:inline-block; padding:.75rem 1.5rem; background:#ff6600; color:#fff; border:none; border-radius:6px; text-decoration:none; font-weight:600; transition:background .2s; }
    .btn:hover { background:#e65500; }
  </style>
</head>
<body>
  <header>
    <h1>QuickCart</h1>
  </header>
  <main>
    <div class="status-banner">
      <h1>🎉 Thank you for your purchase!</h1>
      <p>Your order #<strong><?= htmlspecialchars($order['orderID']) ?></strong> was placed on <strong><?= htmlspecialchars($order['orderDate']) ?></strong>.</p>
    </div>

    <section class="order-details">
      <h2>Order Details</h2>
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['productName']) ?></td>
            <td><?= $p['quantity'] ?></td>
            <td>$<?= number_format($p['unitPrice'],2) ?></td>
            <td>$<?= number_format($p['unitPrice'] * $p['quantity'],2) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Total</td>
            <td>$<?= number_format($order['totalAmount'],2) ?></td>
          </tr>
        </tfoot>
      </table>
    </section>

    <div class="actions">
      <a href="<?= $baseURL ?>/products" class="btn">Continue Shopping</a>
    </div>
  </main>
</body>
</html>
