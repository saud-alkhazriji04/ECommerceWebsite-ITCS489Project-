<?php
require_once 'model.php';
class Order extends Model {
  public function create($custID, $total, $status) {
    $stmt = $this->db->prepare(
      "INSERT INTO `Order` (customerID, totalAmount, orderStatus)
       VALUES (?, ?, ?)"
    );
    $stmt->execute([$custID, $total, $status]);
    return $this->db->lastInsertId();
  }

  public function getById($id) {
    $stmt = $this->db->prepare("SELECT * FROM `Order` WHERE orderID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
