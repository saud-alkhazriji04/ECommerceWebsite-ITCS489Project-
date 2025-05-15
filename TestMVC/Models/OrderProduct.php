<?php
require_once 'model.php';
class OrderProduct extends Model {
  public function create($orderID, $prodID, $qty, $price) {
    $stmt = $this->db->prepare(
      "INSERT INTO OrderProduct (orderID, productID, quantity, unitPrice)
       VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$orderID, $prodID, $qty, $price]);
  }

  public function getByOrder($orderID) {
    $stmt = $this->db->prepare(
      "SELECT p.productName, op.quantity, op.unitPrice
       FROM OrderProduct op
       JOIN Product p ON p.productID = op.productID
       WHERE op.orderID = ?"
    );
    $stmt->execute([$orderID]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
