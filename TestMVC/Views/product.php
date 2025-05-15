<?php
// app/views/product.php
// assumes $product (assoc array) and $related (array) are defined by the controller
?>
<style>
/* Internal CSS for flash message behavior */
.btn-container {
  position: relative;
  display: inline-block;
}
#flashMessage {
  position: absolute;
  top: 100%;
  left: 0;
  margin-top: 0.5rem;
  padding: 0.5rem 1rem;
  color: #2d3748;
  white-space: nowrap;
  opacity: 1;
  transition: opacity 0.5s ease;
  pointer-events: none;
  z-index: 10;
}
#flashMessage.hide {
  opacity: 0;
}
</style>


<div class="product-detail container">
  <div class="gallery">
    <div class="main-img">
      <img src="assets/<?= htmlspecialchars($product['imageFilename']) ?>" alt="<?= htmlspecialchars($product['productName']) ?>">
    </div>
    <div class="thumbs">
      <img src="assets/<?= htmlspecialchars($product['imageFilename']) ?>" alt="">
    </div>
  </div>

  <div class="info">
    <h1><?= htmlspecialchars($product['productName']) ?></h1>
    <div class="rating">
      <span>★</span><span>★</span><span>★</span><span>★</span><span>☆</span>
      <small>(4.5)</small>
    </div>
    <p class="description"><?= nl2br(htmlspecialchars($product['productDescription'])) ?></p>

    <div class="price">
      $<?= number_format($product['price'],2) ?>
    </div>

    <div class="btn-container">
      <a href="/eComWebSite/TestMVC/Public/cart/add/<?= $product['productID'] ?>" class="btn-add">Add to Cart</a>
      <?php if (!empty($_SESSION['flash'])): ?>
        <div id="flashMessage"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
      <?php endif; ?>
    </div>

    <a href="/eComWebSite/TestMVC/Public/cart/buy/<?= $product['productID'] ?>" class="btn-buy">Buy now</a>
  </div>
</div>

<h2 class="section-title">Featured Products</h2>
<div class="product-grid">
  <?php foreach ($related as $p): ?>
    <div class="product-card">
      <img src="assets/<?= htmlspecialchars($p['imageFilename']) ?>" alt="<?= htmlspecialchars($p['productName']) ?>">
      <h3><?= htmlspecialchars($p['productName']) ?></h3>
      <div class="price">$<?= number_format($p['price'],2) ?></div>
      <a href="/eComWebSite/TestMVC/Public/product/<?= $p['productID'] ?>" class="btn-buy">Buy now</a>
    </div>
  <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const flash = document.getElementById('flashMessage');
  if (!flash) return;

  setTimeout(() => {
    flash.classList.add('hide');
    setTimeout(() => flash.remove(), 500); // Wait for fade to finish
  }, 3000);
});
</script>