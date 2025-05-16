
<h2>Shop All Products</h2>

<section class="hero">
  <div class="slides">
    <div class="slide">
      <div class="slide-content">
        <h2>IPhone 16 - Hello Apple Intelligence</h2>
        <p>Hurry up—only a few left!</p>
        <a href="product/45" class="btn">Shop Now</a>
      </div>
      <img src="/eComWebSite/uploads/image.png" alt="iphone">
    </div>
    <!-- more .slide divs as needed -->
  </div>
  <div class="dots">
    <div class="dot active"></div>
    <div class="dot"></div>
    <div class="dot"></div>
  </div>
</section>

<div class="product-grid">
<?php foreach ($products as $p): ?>
    <!-- <div class="product-card">
        <img class="aa" src="../../uploads/<?= htmlspecialchars($p['imageFilename']) ?>" alt="<?= $p['productName'] ?>">
        <h3><?= htmlspecialchars($p['productName']) ?></h3>
        <p>$<?= number_format($p['price'], 2) ?></p>
    </div> -->


    <div class="product-card">
        <img src="../../uploads/<?= htmlspecialchars($p['imageFilename']) ?>" alt="<?= htmlspecialchars($p['productName']) ?>">
        <h3><?= htmlspecialchars($p['productName']) ?></h3>
        <div class="price">$<?= number_format($p['price'],2) ?></div>
        <div class="rating">
            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
        <!-- <a href="#" class="btn-buy">Buy now</a> -->
         <a 
            href="/eComWebSite/TestMVC/Public/product/<?= $p['productID'] ?>" 
            class="btn-buy"
        >
            Shop
        </a>

    </div>



<?php endforeach; ?>
</div>

