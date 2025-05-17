<?php
// $items      = $_SESSION['cart'];
// $subtotal   computed in controller
// you can compute tax & total here:
$tax    = round($subtotal * 0.02, 2);
$total  = $subtotal + $tax;
$count  = array_sum(array_column($items, 'quantity'));
?>

<div class="cart-page container">
  <h1>Your <span>Cart</span> <small><?= $count ?> Item<?= $count>1?'s':'' ?></small></h1>
  <div class="cart-content">
    <div class="cart-items">
      <table>
        <thead>
          <tr>
            <th>Product Details</th><th>Price</th><th>Quantity</th><th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($items as $i): ?>
          <tr>
            <td class="prod-info">
              <img src="/eComWebSite/uploads/<?= htmlspecialchars($i['image']) ?>" alt="">
              <div>
                <strong><?= htmlspecialchars($i['name']) ?></strong><br>
                <!-- <a href="/cart/remove/<?= $i['productID'] ?>">Remove</a> -->
                 <a href="/eComWebSite/TestMVC/Public/cart/remove/<?= $i['productID'] ?>">Remove</a>
              </div>
            </td>
            <td>$<?= number_format($i['price'],2) ?></td>
            <td>
              <!-- Decrement -->
              <a class="qty-btn" href="/eComWebSite/TestMVC/Public/cart/update/<?= $i['productID'] ?>/dec">‹</a>
              <?= $i['quantity'] ?>
              <!-- Increment -->
              <a class="qty-btn" href="/eComWebSite/TestMVC/Public/cart/update/<?= $i['productID'] ?>/inc">›</a>
            </td>
            <td>$<?= number_format($i['price'] * $i['quantity'],2) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <!-- <a href="/products" class="continue">← Continue Shopping</a> -->
         <!-- Continue Shopping -->
        <a href="products" class="continue">← Continue Shopping</a>

        
    </div>

    <aside class="order-summary">
      <h2>Order Summary</h2>
      <label>Select Address</label>
      <select>
        <option>Select Address</option>
      </select>

      <label>Promo Code</label>
      <input type="text" placeholder="Enter promo code">
      <button class="btn-apply">Apply</button>

      <hr>
      <p>Items <span>$<?= number_format($subtotal,2) ?></span></p>
      <p>Shipping Fee <span>Free</span></p>
      <p>Tax (2%) <span>$<?= number_format($tax,2) ?></span></p>
      <hr>
      <p class="total">Total <span>$<?= number_format($total,2) ?></span></p>
      <!-- <button class="btn-place">Place Order</button> -->
      <!-- Place Order form -->
        <form action="order/place" method="POST" style="display:inline">
            <button type="submit" class="btn-place">
              Place Order
            </button>
            <!-- <a href="eComWebSite/TestMVC/Public/cart/order/place" >Place Order</a> -->
        </form>
    </aside>
  </div>
</div>
