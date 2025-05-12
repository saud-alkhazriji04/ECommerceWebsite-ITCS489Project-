<?php
require_once '../database.php';
require_once '../models/ProductModel.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
$productModel = new ProductModel($pdo);
$products = $productModel->getAllProducts();

require '../views/browsing.php';
?>
