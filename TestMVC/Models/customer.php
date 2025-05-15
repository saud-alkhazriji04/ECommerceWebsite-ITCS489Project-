<?php
require_once 'Model.php';

class Customer extends Model {
    // public function register($data) {
    //     $stmt = $this->db->prepare("INSERT INTO Customer (name, email, password) VALUES (?, ?, ?)");
    //     return $stmt->execute([$data['name'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
    // }

    public function register(array $data) {
        $sql = "
          INSERT INTO Customer 
            (name, email, password, phoneNumber, dateOfBirth, block, road, houseNumber)
          VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['phoneNumber'] ?? null,
            $data['dateOfBirth'] ?? null,
            $data['block'] ?? null,
            $data['road'] ?? null,
            $data['houseNumber'] ?? null,
        ]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM Customer WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // public function getByEmail($email) {
    //     $stmt = $this->db->prepare("SELECT * FROM Customer WHERE email = ?");
    //     $stmt->execute([$email]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM Customer WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>