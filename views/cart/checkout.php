<?php
require_once 'database.php';
require_once 'models/ProductModel.php';

$productModel = new ProductModel($pdo);
$cart = $_SESSION['cart'] ?? [];
$products = $productModel->getProductsByIds(array_keys($cart));
$total = 0;

foreach ($products as $product) {
    $productId = $product['productID'];
    $quantity = $cart[$productId];
    $subtotal = $product['price'] * $quantity;
    $total += $subtotal;
}

echo '<h2 class="text-xl font-bold mb-4">Checkout</h2>';
echo '<p class="mb-2">Total Amount: $' . number_format($total, 2) . '</p>';
echo '<p class="text-green-700">Thank you for your purchase!</p>';
?>
