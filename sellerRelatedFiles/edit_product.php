<?php
require_once '../database.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

if (!isset($_GET['id'])) {
    die("Product ID is required.");
}
$productID = (int) $_GET['id'];

// Fetch product info as an object
$stmt = $pdo->prepare("SELECT * FROM Product WHERE productID = ?");
$stmt->execute([$productID]);
$product = $stmt->fetch(PDO::FETCH_OBJ);

if (!$product) {
    die("Product not found.");
}

// Fetch categories for the dropdown as objects
$catStmt    = $pdo->query("SELECT * FROM Category ORDER BY categoryName");
$categories = $catStmt->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    .form-container {
      background: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: 0 auto;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    h1 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .form-group input[type="file"] {
      display: block;
    }
    .submit-btn {
      background: #28a745;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      display: block;
      margin: 0 auto;
    }
    .submit-btn:hover {
      background: #218838;
    }

    p {text-align: center;}
  </style>
</head>
<body>
  <div class="form-container">
    <p>Comming Soon (Beta)</p>
    <h1>Edit Product: <?= htmlspecialchars($product->productName, ENT_QUOTES) ?></h1>
    <form action="update_product.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="productID" value="<?= $productID ?>">

      <div class="form-group">
        <label for="productName">Name:</label>
        <input
          type="text"
          id="productName"
          name="productName"
          value="<?= htmlspecialchars($product->productName, ENT_QUOTES) ?>"
          required
        >
      </div>

      <div class="form-group">
        <label for="productDescription">Description:</label>
        <textarea
          id="productDescription"
          name="productDescription"
          rows="4"
        ><?= htmlspecialchars($product->productDescription, ENT_QUOTES) ?></textarea>
      </div>

      <div class="form-group">
        <label for="price">Price:</label>
        <input
          type="number"
          id="price"
          name="price"
          step="0.01"
          value="<?= htmlspecialchars($product->price, ENT_QUOTES) ?>"
          required
        >
      </div>

      <div class="form-group">
        <label for="categoryID">Category:</label>
        <select id="categoryID" name="categoryID">
          <?php foreach ($categories as $cat): ?>
            <option
              value="<?= $cat->categoryID ?>"
              <?= $cat->categoryID == $product->categoryID ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($cat->categoryName, ENT_QUOTES) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="productImage">Image (optional):</label>
        <input type="file" id="productImage" name="productImage">
      </div>

      <button type="submit" class="submit-btn">Save Changes</button>
    </form>

    <!-- Go Back button -->
    <button
      type="button"
      onclick="window.location.href='product_list_page.php';"
      style="background:#6c757d; color:#fff; padding:10px 20px; border:none; border-radius:4px; cursor:pointer; margin-right:10px;"
    >
      ← Go Back
    </button>
  </div>
</body>
</html>


