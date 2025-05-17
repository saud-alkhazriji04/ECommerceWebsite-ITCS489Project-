<?php
require_once '../database.php';
$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid product ID.');
}

$productID = (int) $_GET['id'];

// 1) Optionally, delete any associated images on disk
//    (if you’re storing filenames in `imageFilename` or `pictures`)
//$stmtImg = $pdo->prepare("SELECT imageFilename FROM Product WHERE productID = ?");
//$stmtImg->execute([$productID]);
//if ($fn = $stmtImg->fetchColumn()) {
//    @unlink(__DIR__ . '/uploads/' . $fn);
//}

// 2) Delete the product (will fail if there are RESTRICT FKs—adjust as needed)
$stmt = $pdo->prepare("DELETE FROM Product WHERE productID = ?");
$stmt->execute([$productID]);

// 3) Redirect back
header('Location: product_list_page.php');
exit;
?>