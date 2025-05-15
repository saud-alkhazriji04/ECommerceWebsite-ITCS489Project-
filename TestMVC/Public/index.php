<?php
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// // $base = '/Public';
// // if (strpos($uri, $base) === 0) {
// //     $uri = substr($uri, strlen($base)) ?: '/';
// // }
// echo $uri . '<br>';
// switch ($uri) {
//     case '/EcomWebSite/TestMVC/Controllers/HomeController.php':
//         require '../controllers/HomeController.php';
//         (new HomeController())->index();
//         break;
//     case '/EcomWebSite/TestMVC/Controllers/ProductController.php':
//         require '../controllers/ProductController.php';
//         (new ProductController())->index();
//         break;
//     case '/EcomWebSite/TestMVC/Controllers/AuthController.php':
//         require '../controllers/AuthController.php';
//         (new AuthController())->login();
//         break;
//     case '/EcomWebSite/TestMVC/Controllers/AuthController.php':
//         require '../controllers/AuthController.php';
//         (new AuthController())->register();
//         break;
//     default:
//         http_response_code(404);
//         echo "404 Not Found";
//         break;
// }
?>



<?php
session_start();

// 1) Normal‑ize the URI so that requests to /TestMVC/Public/... route correctly
//    Remove everything up through "/Public"

// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// $base = '/eComWebSite/TestMVC/Public';
// if (strpos($uri, $base) === 0) {
//     $uri = substr($uri, strlen($base));
// }
// $uri = $uri ?: '/';

// 2) Use __DIR__ to require controllers from the project root, not from Public
// switch ($uri) {
//     case '/':
//         require __DIR__ . '/../controllers/HomeController.php';
//         (new HomeController())->index();
//         break;

//     case '/products':
//         require __DIR__ . '/../controllers/ProductController.php';
//         (new ProductController())->index();
//         break;

//     case preg_match('#^/product/(\d+)$#', $uri, $m) ? true : false:
//         require __DIR__ . '/../controllers/ProductController.php';
//         (new ProductController())->detail($m[1]);
//         break;

//     case '/login':
//         require __DIR__ . '/../controllers/AuthController.php';
//         (new AuthController())->login();
//         break;

//     case '/register':
//         require __DIR__ . '/../controllers/AuthController.php';
//         (new AuthController())->register();
//         break;

//     // View Cart
//     case $uri === '/cart':
//         require __DIR__ . '/../controllers/CartController.php';
//         (new CartController())->index();
//         break;

//     // Add to Cart (AJAX or normal)
//     case preg_match('#^/cart/add/(\d+)$#', $uri, $m):
//         require __DIR__ . '/../controllers/CartController.php';
//         (new CartController())->add($m[1]);
//         break;

//     // Buy Now (add then redirect to /cart)
//     case preg_match('#^/cart/buy/(\d+)$#', $uri, $m):
//         require __DIR__ . '/../controllers/CartController.php';
//         (new CartController())->buy($m[1]);
//         break;

//     default:
//         http_response_code(404);
//         echo "404 Not Found";
//         break;
// }





$uri   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base  = '/eComWebSite/TestMVC/Public';
if (strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$uri = $uri ?: '/';

switch (true) {
    case $uri === '/':
        require __DIR__ . '/../controllers/HomeController.php';
        (new HomeController())->index();
        break;

    case $uri === '/products':
        require __DIR__ . '/../controllers/ProductController.php';
        (new ProductController())->index();
        break;

    case preg_match('#^/product/(\d+)$#', $uri, $m):
        require __DIR__ . '/../controllers/ProductController.php';
        (new ProductController())->detail($m[1]);
        break;

    case $uri === '/login':
        require __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->login();
        break;

    case $uri === '/register':
        require __DIR__ . '/../controllers/AuthController.php';
        (new AuthController())->register();
        break;

    case $uri === '/cart':
        require __DIR__ . '/../controllers/CartController.php';
        (new CartController())->index();
        break;

    case preg_match('#^/cart/add/(\d+)$#', $uri, $m):
        require __DIR__ . '/../controllers/CartController.php';
        (new CartController())->add($m[1]);
        break;

    case preg_match('#^/cart/buy/(\d+)$#', $uri, $m):
        require __DIR__ . '/../controllers/CartController.php';
        (new CartController())->buy($m[1]);
        break;

    // Place Order
    case $uri === '/order/place':
        require __DIR__ . '/../controllers/OrderController.php';
        (new OrderController())->place();
        break;
        //newly added by me
    case $uri === '/eComWebSite/TestMVC/Public/cart/order/place':
        require __DIR__ . '/../Controllers/OrderController.php';
        (new OrderController())->place();
        break;

    // Order Confirmation
    case preg_match('#^/order/success/(\d+)$#', $uri, $m):
        require __DIR__ . '/../controllers/OrderController.php';
        (new OrderController())->success($m[1]);
        break;

    case preg_match('#^/cart/remove/(\d+)$#', $uri, $m):
        require __DIR__ . '/../controllers/CartController.php';
        (new CartController())->remove($m[1]);
        break;

    // Update quantity: inc or dec
    case preg_match('#^/cart/update/(\d+)/(inc|dec)$#', $uri, $m):
        require __DIR__ . '/../controllers/CartController.php';
        (new CartController())->update($m[1], $m[2]);
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        echo "<BR>" . $uri;
        break;
}