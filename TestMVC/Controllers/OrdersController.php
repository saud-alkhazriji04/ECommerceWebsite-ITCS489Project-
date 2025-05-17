<?php
require_once __DIR__ . '/../models/Orders.php';
require_once __DIR__ . '/../models/OrderProduct.php';

class OrdersController {
    public function index() {
        // session_start();
        if (empty($_SESSION['user'])) {
            header("Location: login");
            exit;
        }

        $custID = $_SESSION['user']['customerID'];
        $orderModel = new Order();
        $orders = $orderModel->getByCustomer($custID);

        // Attach products to each order
        $opModel = new OrderProduct();
        foreach ($orders as &$ord) {
            $ord['items'] = $opModel->getByOrder($ord['orderID']);
        }
        unset($ord);

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/orders.php';
        require __DIR__ . '/../views/layout/footer.php';
    }
}
