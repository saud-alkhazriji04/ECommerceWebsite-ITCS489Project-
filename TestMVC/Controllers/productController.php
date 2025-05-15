<?php
// require_once '../models/Product.php';

// class ProductController {
//     public function index() {
//         $product = new Product();
//         $products = $product->getAll();
//         require '../views/shop.php';
//     }
// }

?>

<?php
// require __DIR__ . '../Models/product.php';
require_once __DIR__ . '/../Models/Product.php';

class ProductController {
    public function index() {
        $model = new Product();
        $products = $model->getAll();       // ← define $products
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/shop.php';   // shop.php now sees $products
        require __DIR__ . '/../views/layout/footer.php';
    }

    public function detail($id) {
        // load the single product
        $model   = new Product();
        $product = $model->getById($id);

        // load some featured items (optional)
        $related = $model->getFeatured(4);

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/product.php';
        require __DIR__ . '/../views/layout/footer.php';
    }
}
