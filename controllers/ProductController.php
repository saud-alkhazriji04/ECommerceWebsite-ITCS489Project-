<?php
require_once 'database.php';
require_once 'models/ProductModel.php';

$productModel = new ProductModel($pdo);
$products = $productModel->getAllProducts();

require 'views/browsing.php';
?>
