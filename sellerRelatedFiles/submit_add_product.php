<?php
// 1) bootstrap your DB connection (e.g. via PDO)

require '../database.php';  // set up $pdo

$pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);

// 2) config
$uploadDir  = __DIR__ . '/../uploads/';
// $productID  = isset($_POST['productID']) ? (int)$_POST['productID'] : 0;
// $productID = 3;

// // 3) basic validation
// if (!$productID || !isset($_FILES['image'])) {
//     die('Invalid request.');
// }

// $fileError = $_FILES['image']['error'];
// if ($fileError !== UPLOAD_ERR_OK) {
//     die('Upload error code: ' . $fileError);
// }

// // 4) verify it’s an image
// $tmpName = $_FILES['image']['tmp_name'];
// $imageInfo = getimagesize($tmpName);
// if ($imageInfo === false) {
//     die('Not a valid image.');
// }

// // 5) build a unique filename
// $origName  = basename($_FILES['image']['name']);
// $ext       = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
// $allowed   = ['jpg','jpeg','png','gif'];
// if (!in_array($ext, $allowed, true)) {
//     die('Unsupported file type.');
// }
// $newName = 'prod_' . $productID . '_' . uniqid() . '.' . $ext;

// // 6) move to uploads folder
// if (!move_uploaded_file($tmpName, $uploadDir . $newName)) {
//     die('Failed to move uploaded file.');
// }

// not used currently.
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

// $pdo = new PDO($dsn, $db_user, $db_password, $PDOoptions);
// $sql = "UPDATE Product
//      SET imageFilename = :fn
//    WHERE productID     = :pid";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['pid' => $productID, 'fn' => $newName]);
// $row = $stmt->fetch();

// // 8) (Optional) delete old image file if you want
// if (!empty($_POST['oldImage'])) {
//     @unlink($uploadDir . $_POST['oldImage']);
// }

// 9) redirect back to edit page
// header("Location: index.php"); // change this later to product list page --------------


function validate_image($image) {
    $uploadDir  = __DIR__ . '/../uploads/';

    // 3) basic validation
    $fileError = $image['error'];


    if ($fileError !== UPLOAD_ERR_OK) {
        die('Upload error code: ' . $fileError);
    }

    // 4) verify it’s an image
    $tmpName = $image['tmp_name'];
    $imageInfo = getimagesize($tmpName);
    if ($imageInfo === false) {
        die('Not a valid image.');
    }

    // 5) build a unique filename
    $origName  = basename($image['name']);
    $ext       = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed   = ['jpg','jpeg','png','gif'];
    if (!in_array($ext, $allowed, true)) {
        die('Unsupported file type.');
    }


    // do this step later in another function after creating a row for the product and getting an id
    // $newName = 'prod_' . $productID . '_' . uniqid() . '.' . $ext;

    // // 6) move to uploads folder
    // if (!move_uploaded_file($tmpName, $uploadDir . $newName)) {
    //     die('Failed to move uploaded file.');
    // }
}

// function get_categoryID_from_categoryName($categoryName) {
//     global $pdo;

//     $sql = "SELECT * FROM category WHERE categoryName = :categoryName";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute(['categoryName' => $categoryName]);
//     $row = $stmt->fetch();
//     if ($row) {
//         return $row -> categoryName;
//     } else {
//         // do some error
//     }
// }




function add_product($product_name, $product_description, $categoryID, $price) {


    // require '../category_name_&&_ID.php';
    global $pdo;

    // $categoryID = get_categoryID_from_categoryName($category);

    $sql = "INSERT INTO product (productName, productDescription, price, categoryID) VALUES (:name, :description, :price, :categotyId)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $product_name, 'description' => $product_description, 'price' => $price, 'categotyId' => $categoryID]);
        
        // header("location: index.php");
    } catch (PDOException $e) {
        // $error = "<p class='error'>This email is already used! Use another or sign in.</p>";
        // do some error
    }
}



?>

