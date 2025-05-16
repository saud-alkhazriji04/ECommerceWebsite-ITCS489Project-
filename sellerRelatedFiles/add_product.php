<?php
// $uploadDir = __DIR__ . '/uploads/';
// $message = '';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

//     for ($i = 0; $i < 4; $i++) {
//         if (!empty($_FILES['images']['name'][$i])) {
//             $tmp  = $_FILES['images']['tmp_name'][$i];
//             $name = basename($_FILES['images']['name'][$i]);
//             $dst  = $uploadDir . uniqid('img_') . '_' . $name;

//             if (move_uploaded_file($tmp, $dst)) {
//                 $message .= "Image #{$i} uploaded successfully.<br>";
//             } else {
//                 $message .= "Error uploading image #{$i}.<br>";
//             }
//         }
//     }
// }
?>

<!-- sanatize before submiting form to database -->
<?php 

  include ("submit_add_product.php");
  require '../category_name_&&_ID.php';
  require 'image_functions.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $product_name = filter_input(INPUT_POST, "productName", FILTER_SANITIZE_SPECIAL_CHARS);
      $product_description = filter_input(INPUT_POST, "productDescription", FILTER_SANITIZE_SPECIAL_CHARS);
      $category = $_POST["category"];
      $price = $_POST["price"];
      $image = $_FILES['image'];

      if (empty($product_name) || empty($product_description) || empty($category) || empty($price) || !isset($image)) {
          $error = "please fill all the fields";
      } else {
        validate_image($image);
        $categoryID = get_categoryID_from_categoryName($category);
        add_product($product_name, $product_description, $categoryID, $price);
        add_Product_image($product_name, $product_description, $categoryID, $price, $image);
      }

  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>eCommerce - Add Product</title>
  <link rel="stylesheet" href="\eComWebSite\sellerRelatedFiles/style/seller_page_styles.css"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #f9f9f9; color: #333; }
    header { display: flex; justify-content: space-between; align-items: center;
                padding: 1rem; background: #fff; border-bottom: 1px solid #ddd; }
    .logo { font-size: 1.5rem; font-weight: bold; color: #f57c00; }
    .logout-btn { background: #444; color: #fff; border: none; padding: .5rem 1rem;
                    border-radius: 20px; cursor: pointer; }
    .container { display: flex; min-height: 100vh; }
    aside { width: 200px; background: #fff; border-right: 1px solid #ddd; }
    aside nav a { display: flex; align-items: center; padding: .75rem 1rem;
                    text-decoration: none; color: #333; transition: background .2s; }
    aside nav a.active, aside nav a:hover { background: #ffe5d0; color: #f57c00; }
    aside nav a span { margin-right: .5rem; font-size: 1.2rem; }
    main { flex: 1; padding: 2rem; }

    .orders-list { list-style: none; }
    .order-item { display: flex; justify-content: space-between; background: #fff;
                    padding: 1rem; margin-bottom: .5rem; border-radius: 4px;
                    border: 1px solid #eee; }
    .order-detail { display: flex; }
    .order-icon { font-size: 2rem; color: #f57c00; margin-right: 1rem; }
    .order-info { display: flex; flex-direction: column; justify-content: space-between; }
    .products { font-weight: 500; }
    .meta { font-size: .9rem; color: #666; line-height: 1.4; }
    .right-info { text-align: right; display: flex; flex-direction: column;
                    justify-content: space-between; }
    .amount { font-weight: bold; }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">eCommerce - Seller Page</div>
    <button class="logout-btn">Logout</button>
  </header>

  <div class="container">
    <aside class="sidebar">
      <!-- <a href="add_product.php" class="active"><span>➕</span> Add Product</a>
      <a href="product_list_page.php"><span>📋</span> Product List</a>
      <a href="orders_page.php"><span>✅</span> Orders</a>
      <a href="dashboard.php"><span>📊</span> DashBoard</a> -->
      <nav>
        <a href="add_product.php" class="active"><span>➕</span> Add Product</a>
        <a href="product_list_page.php"><span>📋</span> Product List</a>
        <a href="orders_page.php"><span>✅</span> Orders</a>
        <a href="dashboard.php"><span>📊</span> DashBoard</a>
      </nav>
    </aside>

    <main>
      <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data" id="product-form">
        <h2>Add New Product</h2> 
        <label for="images0">Product Image</label>
        <div class="image-grid">
          <label class="upload-box">
            <input
              id="images0"
              name="image"
              type="file"
              accept="image/*"
              data-index="0"
              class="hidden"              
            />
            <div class="placeholder">Upload</div>
            <img class="preview" id="preview-0" src="" alt="" />
            <div class="filename" id="filename-0"></div>
          </label>
        </div>

        <div class="form-group">
          <label for="name">Product Name</label>
          <input id="name" name="productName" type="text" placeholder="Type here" required/>
        </div>

        <div class="form-group">
          <label for="desc">Product Description</label>
          <textarea id="desc" name="productDescription" rows="4" placeholder="Type here" required></textarea>
        </div>

        <div class="row">
          <div class="form-group small">
            <label for="category">Category</label>
            <select id="category" name="category">
              <option>Earphone</option>
              <option>Headphone</option>
              <option>Watch</option>
              <option>Smartphone</option>
              <option>Laptop</option>
              <option>Camera</option>
              <option>Accessories</option>
            </select>
          </div>
          <div class="form-group small">
            <label for="price">Product Price</label>
            <input id="price" name="price" type="number" placeholder="0.0" required/>
          </div>
        </div>

        <button type="submit" class="add-btn">Add Product</button>
      </form>
    </main>

  </div>

  <script src="add_product_script.js"></script>
</body>
</html>
