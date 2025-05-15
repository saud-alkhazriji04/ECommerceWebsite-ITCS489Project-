<?php
// require_once '../models/Product.php';

// class HomeController {
//     public function index() {
//         $product = new Product();
//         $products = $product->getAll();
//         require '../views/home.php';
//     }
// }

?>

<?php
require __DIR__ . '/../models/Product.php';

class HomeController {
    public function index() {
        $model = new Product();
        $products = $model->getAll();       // ← define $products
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/home.php';
        require __DIR__ . '/../views/layout/footer.php';
    }
}