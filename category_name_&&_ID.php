<?php
    require 'database.php';  // set up $pdo
    $pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

    function get_categoryID_from_categoryName($categoryName) {
        global $pdo;

        $sql = "SELECT * FROM category WHERE categoryName = :categoryName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['categoryName' => $categoryName]);
        $row = $stmt->fetch();
        if ($row) {
            return $row -> categoryID;
        } else {
            // do some error
        }
    }

?>