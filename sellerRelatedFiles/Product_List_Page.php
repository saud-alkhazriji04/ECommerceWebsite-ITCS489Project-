<?php
// File: product_list.php
// 1) Bootstrap DB connection
require_once '../database.php'; // sets up $pdo via PDO
require '../category_name_&&_ID.php';
require '../getProductImage.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
// 2) Fetch all products
$sql = "SELECT productID, productName, categoryID, price, imageFilename FROM product ORDER BY productName";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller - Product List</title>
  <link rel="stylesheet" href="\eComWebSite\sellerRelatedFiles\style\product_list_page_styles.css"/>
</head>
<body>
  <header>
    <div class="logo">eCommerce - Seller Page</div>
    <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
  </header>

  <div class="container">
    <aside>
      <nav>
        <a href="add_product.php"><span>➕</span> Add Product</a>
        <a href="product_list_page.php" class="active"><span>📋</span> Product List</a>
        <a href="orders_page.php"><span>✅</span> Orders</a>
        <a href="dashboard.php"><span>📊</span> DashBoard</a>
      </nav>
    </aside>

    <main>
      <h2>All Products</h2>
      <table class="product-table">
        <thead>
          <tr>
            <th></th>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $prod): ?>
          <tr>
            <td>
              <?php if (!empty($prod->imageFilename)): ?>
                <img src="<?= htmlspecialchars(getProductImageSrc($prod->productID), ENT_QUOTES) ?>"
                     alt="<?= htmlspecialchars($prod->productName, ENT_QUOTES) ?>"
                     class="thumb">
              <?php endif; ?>
              
            </td>
            <td><?= htmlspecialchars($prod->productName, ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars(get_categoryName_from_categoryID($prod->categoryID), ENT_QUOTES) ?></td>
            <td>$<?= number_format($prod->price, 2) ?></td>
            <td>
              <button class="visit-btn" onclick="viewProduct(<?= $prod->productID ?>)">
                Visit
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                  <path d="M14 3h7v7m0-7L10 14" stroke="#fff" stroke-width="2"/>
                  <path d="M5 11v8a2 2 0 002 2h8" stroke="#fff" stroke-width="2"/>
                </svg>
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </div>

  <script>
    function viewProduct(id) {
      // Redirect to product detail or seller edit page
      window.location.href = 'edit_product.php?id=' + id;
    }
  </script>
</body>
</html>