<?php include 'layout/header.php'; ?>
<h2>Popular Products</h2>
<div class="product-grid">
<?php foreach ($products as $p): ?>
    <div class="product-card">
        <img src="/assets/<?= htmlspecialchars($p['imageFilename']) ?>" alt="<?= $p['productName'] ?>">
        <h3><?= htmlspecialchars($p['productName']) ?></h3>
        <p>$<?= number_format($p['price'], 2) ?></p>
    </div>
<?php endforeach; ?>
</div>
<?php include 'layout/footer.php'; ?>
