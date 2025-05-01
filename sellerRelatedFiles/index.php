<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Hello</h1>
  <form
    action="upload_image.php"
    method="post"
    enctype="multipart/form-data"
  >
    <!-- Pass along the productID you’re editing -->
    <input
      type="hidden"
      name="productID"
      value="<?= htmlspecialchars($productID) ?>"
    >

    <label for="image">Product Image:</label>
    <input
      type="file"
      name="image"
      id="image"
      accept="image/*"
      required
    >

  <button type="submit">Upload Image</button>
</form>
</body>
</html>


<?php
// require 'database.php';
// $productID = 3;
// // fetch $row from Product
// $pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
// $sql = "SELECT * FROM product WHERE productID = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['id' => $productID]);
// $row = $stmt->fetch();

require '../getProductImage.php'; // contains getProductImageSrc()

$productID = 21;
$imageSrc = getProductImageSrc($productID);

if ($imageSrc) {
    echo '<img src="' . $imageSrc . '" alt="Product Image">';
} else {
    echo '<p>No image available for this product.</p>';
}
?>




