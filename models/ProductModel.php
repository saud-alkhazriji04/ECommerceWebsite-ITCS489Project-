<?php
class ProductModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllProducts() {
        $sql = "SELECT p.*, c.categoryName FROM Product p 
                LEFT JOIN Category c ON p.categoryID = c.categoryID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductByID($id) {
        $sql = "SELECT p.*, c.categoryName FROM Product p 
                LEFT JOIN Category c ON p.categoryID = c.categoryID 
                WHERE p.productID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductsByIds($ids) {
        if (empty($ids)) return [];
    
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->pdo->prepare("SELECT * FROM product WHERE productID IN ($placeholders)");
        $stmt->execute($ids);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
