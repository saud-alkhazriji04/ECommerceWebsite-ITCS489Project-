<?php 
require '../database.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);


function add_Product_image($productName, $productDescription, $categoryID, $price, $image) {
    global $pdo;
    $uploadDir  = __DIR__ . '/../uploads/';

    try {
        // 1) Find the productID matching the provided details
        $sql = "SELECT productID
                  FROM product
                 WHERE productName        = :name
                   AND productDescription = :description
                   AND categoryID         = :categoryID
                   AND price              = :price";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'        => $productName,
            ':description' => $productDescription,
            ':categoryID'  => $categoryID,
            ':price'       => $price,
        ]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if (! $row) {
            throw new Exception('Product not found.');
        }
        $productID = $row->productID;

        // 2) Prepare the image upload
        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $tmpName  = $image['tmp_name'];
        $origName = basename($image['name']);
        $ext      = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
        $newName  = "prod_{$productID}_" . uniqid() . ".{$ext}";

        if (! move_uploaded_file($tmpName, $uploadDir . $newName)) {
            throw new Exception('Failed to move uploaded file.');
            die();
        }

        // 3) Update the database with the new filename
        $sql = "UPDATE product
                   SET imageFilename = :fn
                 WHERE productID     = :pid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fn'  => $newName,
            ':pid' => $productID,
        ]);

        return $newName;

    } catch (Exception $e) {
        // better to log the error in production
        error_log('add_Product_image error: ' . $e->getMessage());
        return null;
    }
}
