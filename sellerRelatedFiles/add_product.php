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
</head>
<body>
  <header class="header">
    <div class="logo">eCommerce - Seller Page</div>
    <button class="logout-btn">Logout</button>
  </header>

  <div class="container">
    <aside class="sidebar">
      <a href="add_product.php" class="active"><span>➕</span> Add Product</a>
      <a href="product_list_page.php"><span>📋</span> Product List</a>
      <a href="orders_page.php"><span>✅</span> Orders</a>
    </aside>

    <main class="main">
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
