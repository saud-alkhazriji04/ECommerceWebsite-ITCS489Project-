<?php
// expects $orders = [
//   [orderID, totalAmount, orderDate, orderStatus, 'items'=>[...]],
//   ...
// ];
?>
<style>
  .orders-container { max-width:900px; margin:2rem auto; }
  .orders-container h1 { font-size:1.75rem; margin-bottom:1rem; text-align:center; }
  .order-card {
    background:#fff; border-radius:8px; box-shadow:0 4px 8px rgba(0,0,0,0.05);
    margin-bottom:2rem; overflow:hidden;
  }
  .order-header {
    padding:1rem 2rem; background:#edf2f7; display:flex; justify-content:space-between;
    align-items:center;
  }
  .order-header .info { font-weight:600; }
  .order-header .status { text-transform:capitalize; font-size:0.95rem; }
  .order-details { padding:1rem 2rem; }
  .order-details table { width:100%; border-collapse:collapse; }
  .order-details th, .order-details td {
    padding:0.75rem; border-bottom:1px solid #eee; text-align:left;
  }
  .order-details tfoot td { font-weight:600; }
</style>

<div class="orders-container">
  <h1>My Orders</h1>

  <?php if (empty($orders)): ?>
    <p style="text-align:center; color:#4a5568;">You have no orders yet.</p>
  <?php endif; ?>

  <?php foreach($orders as $o): ?>
    <div class="order-card">
      <!-- header with date/status/total -->
      <div class="order-header">
        <div class="info">
          Order #<?= htmlspecialchars($o['orderID']) ?>
          on <?= date('M j, Y', strtotime($o['orderDate'])) ?>
        </div>
        <div class="status"><?= htmlspecialchars($o['orderStatus']) ?></div>
        <div class="info">$<?= number_format($o['totalAmount'],2) ?></div>
      </div>

      <!-- table of items -->
      <div class="order-details">
        <table>
          <thead>
            <tr>
              <th>Product</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($o['items'] as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['productName']) ?></td>
              <td><?= $item['quantity'] ?></td>
              <td>$<?= number_format($item['unitPrice'],2) ?></td>
              <td>$<?= number_format($item['quantity']*$item['unitPrice'],2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">Total</td>
              <td>$<?= number_format($o['totalAmount'],2) ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  <?php endforeach; ?>
</div>
