<?php
require_once __DIR__ . '/../Models/Orders.php';
require_once __DIR__ . '/../Models/OrderProduct.php';

class OrderController {
    public function place() {
        // 1) Ensure user is logged in and cart not empty
        if (empty($_SESSION['user']) || empty($_SESSION['cart'])) {
            header('Location: /kaka'); exit;
        }
        $customerID = $_SESSION['user']['customerID'];
        $items      = $_SESSION['cart'];

        // 2) Calculate total
        $total = array_reduce($items, function($sum, $i){
            return $sum + $i['price'] * $i['quantity'];
        }, 0);

        // 3) Create Order
        $orderModel = new Order();
        $orderID    = $orderModel->create($customerID, $total, 'Pending');

        // 4) Insert OrderProducts
        $opModel = new OrderProduct();
        foreach ($items as $i) {
            $opModel->create($orderID, $i['productID'], $i['quantity'], $i['price']);
        }

        // 5) (Optionally) create a Payment row here…

        // 6) Clear cart
        unset($_SESSION['cart']);

        // 7) Redirect to success page
        header("Location: /eComWebSite/TestMVC/Public/order/success/$orderID");
        exit;
    }

    public function success($orderID) {
        // load order + items
        $orderModel = new Order();
        $order       = $orderModel->getById($orderID);

        $opModel    = new OrderProduct();
        $products   = $opModel->getByOrder($orderID);

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/order_success.php';
        require __DIR__ . '/../views/layout/footer.php';
    }
}
