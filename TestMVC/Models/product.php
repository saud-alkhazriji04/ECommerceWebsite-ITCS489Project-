<?php
require_once 'Model.php';

class Product extends Model {
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM Product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Product WHERE productID = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFeatured($limit = 4) {
        $stmt = $this->db->query("SELECT * FROM Product ORDER BY RAND() LIMIT $limit");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>