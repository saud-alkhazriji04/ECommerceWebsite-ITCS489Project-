<?php
$total = 0;
echo '<h2 class="text-xl font-bold mb-4">Your Shopping Cart</h2>';
if (empty($products)) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo '<ul class="space-y-4">';
    foreach ($products as $product) {
        $productId = $product['productID'];
        $quantity = $_SESSION['cart'][$productId];
        $subtotal = $product['price'] * $quantity;
        $total += $subtotal;
        echo "<li class='p-4 bg-white shadow rounded'>
                <strong>{$product['productName']}</strong><br>
                Quantity: $quantity<br>
                Subtotal: $" . number_format($subtotal, 2) . "<br>
                <a class='text-red-600' href='index.php?action=removecart&product_id={$productId}'>Remove</a>
              </li>";
    }
    echo "</ul><p class='mt-4 font-bold'>Total: $" . number_format($total, 2) . "</p>";
    echo "<a class='inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded' href='index.php?action=checkout'>Proceed to Checkout</a>";
}
?>
