<?php
require_once 'database.php';
require_once 'models/ProductModel.php';

if (!isset($_GET['id'])) {
    die("Product ID is required");
}

$productID = $_GET['id'];
$productModel = new ProductModel($pdo);
$product = $productModel->getProductByID($productID);

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['productName']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($product['productName']) ?></h1>
    <img src="getProductImage.php?id=<?= $product['productID'] ?>" width="200">
    <p><?= htmlspecialchars($product['productDescription']) ?></p>
    <p>Price: <?= htmlspecialchars($product['price']) ?> BD</p>
    <p>Category: <?= htmlspecialchars($product['categoryName']) ?></p>
</body>
</html>
