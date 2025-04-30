<?php
// 1) bootstrap your DB connection (e.g. via PDO)
require '../database.php';  // set up $pdo

// 2) config
$uploadDir  = __DIR__ . '/../uploads/';
// $productID  = isset($_POST['productID']) ? (int)$_POST['productID'] : 0;
$productID = 3;

// 3) basic validation
if (!$productID || !isset($_FILES['image'])) {
    die('Invalid request.');
}

$fileError = $_FILES['image']['error'];
if ($fileError !== UPLOAD_ERR_OK) {
    die('Upload error code: ' . $fileError);
}

// 4) verify it’s an image
$tmpName = $_FILES['image']['tmp_name'];
$imageInfo = getimagesize($tmpName);
if ($imageInfo === false) {
    die('Not a valid image.');
}

// 5) build a unique filename
$origName  = basename($_FILES['image']['name']);
$ext       = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
$allowed   = ['jpg','jpeg','png','gif'];
if (!in_array($ext, $allowed, true)) {
    die('Unsupported file type.');
}
$newName = 'prod_' . $productID . '_' . uniqid() . '.' . $ext;

// 6) move to uploads folder
if (!move_uploaded_file($tmpName, $uploadDir . $newName)) {
    die('Failed to move uploaded file.');
}

// 7) update the Product row
// $stmt = $pdo->prepare("
//   UPDATE Product
//      SET imageFilename = :fn
//    WHERE productID     = :pid
// ");
// $stmt->execute([
//   ':fn'  => $newName,
//   ':pid' => $productID
// ]);

$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
$sql = "UPDATE Product
     SET imageFilename = :fn
   WHERE productID     = :pid";
$stmt = $pdo->prepare($sql);
$stmt->execute(['pid' => $productID, 'fn' => $newName]);
$row = $stmt->fetch();

// 8) (Optional) delete old image file if you want
if (!empty($_POST['oldImage'])) {
    @unlink($uploadDir . $_POST['oldImage']);
}

// 9) redirect back to edit page
header("Location: index.php");
exit;
