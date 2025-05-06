<!DOCTYPE html>
<html>
<head>
    <title>Browsing Products</title>
</head>
<body>
    <h1>All Products</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="getProductImage.php?id=<?= $product['productID'] ?>" width="150" height="150">
                <h2><?= htmlspecialchars($product['productName']) ?></h2>
                <p><?= htmlspecialchars($product['price']) ?> BD</p>
                <a href="product.php?id=<?= $product['productID'] ?>">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
