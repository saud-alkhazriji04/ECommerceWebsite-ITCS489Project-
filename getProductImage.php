<?php
function getProductImageSrc($productID) {
    require 'database.php'; 

    try {
        $pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
        $sql = "SELECT imageFilename FROM product WHERE productID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $productID]);
        $row = $stmt->fetch();

        if (!empty($row->imageFilename)) {
            return "/eComWebSite/uploads/" . htmlspecialchars($row->imageFilename, ENT_QUOTES);
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    }
}
?>

