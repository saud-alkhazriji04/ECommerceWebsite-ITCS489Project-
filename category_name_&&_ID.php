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

    function get_categoryName_from_categoryID($categoryID) {
        global $pdo;

        $sql = "SELECT * FROM category WHERE categoryID = :categoryID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['categoryID' => $categoryID]);
        $row = $stmt->fetch();
        if ($row) {
            return $row -> categoryName;
        } else {
            // do some error
        }
    }

?>