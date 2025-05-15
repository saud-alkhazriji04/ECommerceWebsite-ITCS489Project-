<?php
require_once __DIR__ . '/../models/Product.php';

class CartController {
    protected $productModel;

    public function __construct() {
        $this->productModel = new Product();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // 1) Show Cart Page
    public function index() {
        // optionally calculate totals
        $items    = $_SESSION['cart'];
        $subtotal = array_reduce($items, function($sum, $item) {
            return $sum + $item['quantity'] * $item['price'];
        }, 0);
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/cart.php';
        require __DIR__ . '/../views/layout/footer.php';
    }

    // 2) Add to Cart
    public function add($id) {
        $p = $this->productModel->getById($id);
        if (!$p) {
            http_response_code(404); exit("Product not found");
        }

        // If already in cart, bump quantity
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'productID' => $p['productID'],
                'name'      => $p['productName'],
                'price'     => $p['price'],
                'image'     => $p['imageFilename'],
                'quantity'  => 1
            ];
        }

        // Flash message
        $_SESSION['flash'] = "{$p['productName']} was added to your cart.";

        // If AJAX request, just return JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            header('Content-Type: application/json');
            echo json_encode(['success'=>true, 'message'=>$_SESSION['flash']]);
            exit;
        }

        // Otherwise back to detail
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    // 3) Buy Now → add & redirect to /cart
    public function buy($id) {
        $this->add($id);
        header("Location: /eComWebSite/TestMVC/Public/cart");
        exit;
    }

    public function remove($id) {
        session_start();
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header("Location: /eComWebSite/TestMVC/Public/cart");
        exit;
    }

    // Increase or decrease quantity
    public function update($id, $action) {
        session_start();
        if (!isset($_SESSION['cart'][$id])) {
            header("Location: /eComWebSite/TestMVC/Public/cart");
            exit;
        }
        if ($action === 'inc') {
            $_SESSION['cart'][$id]['quantity']++;
        } elseif ($action === 'dec') {
            $_SESSION['cart'][$id]['quantity']--;
            // if quantity falls below 1, remove:
            if ($_SESSION['cart'][$id]['quantity'] < 1) {
                unset($_SESSION['cart'][$id]);
            }
        }
        header("Location: /eComWebSite/TestMVC/Public/cart");
        exit;
    }
}
