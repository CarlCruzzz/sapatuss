<?php
include "db.php";

$brand = $_POST['brand'];
$model = $_POST['model'];
$item_id = $_POST['item_id'];

// Handle image upload
$image = null;
$image_type = null;
if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_type = $_FILES['image']['type']; // e.g., image/jpeg
    $image = file_get_contents($image_tmp); // binary data
}

// Insert shoe
$stmt = $conn->prepare("INSERT INTO shoes (brand, model, item_id, image, image_type, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("sssss", $brand, $model, $item_id, $image, $image_type);
$stmt->execute();
$shoe_id = $stmt->insert_id;

// Insert sizes
$sizes = $_POST['size'];
$prices = $_POST['price'];
$stocks = $_POST['stock'];
$variations = $_POST['variation'];

for($i = 0; $i < count($sizes); $i++){
    $size = $sizes[$i];
    $price = $prices[$i];
    $stock = $stocks[$i];
    $variation = $variations[$i];

    $stmt2 = $conn->prepare("INSERT INTO shoe_sizes (shoe_id, size, price, stock, variation) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("iddis", $shoe_id, $size, $price, $stock, $variation);
    $stmt2->execute();
}

header("Location: index.php"); // redirect back to main page
exit;
?>
