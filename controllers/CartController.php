<?php
require_once '../models/ProductModel.php';
require_once '../Database.php';

class CartController {
    public function add() {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'] ?? 1;

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        header('Location: index.php?action=viewcart');
        exit;
    }

    public function remove() {
        session_start();
        $productId = $_GET['product_id'];

        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header('Location: index.php?action=viewcart');
        exit;
    }

    public function view() {
        session_start();

        // Use the same database connection pattern as ProductController
        require_once 'database.php';
        $productModel = new ProductModel($pdo);

        $cart = $_SESSION['cart'] ?? [];
        $products = $productModel->getProductsByIds(array_keys($cart));

        require 'views/cart/viewcart.php';
    }

    public function checkout() {
        session_start();
        require 'views/cart/checkout.php';
    }
}
