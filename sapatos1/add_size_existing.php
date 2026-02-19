<?php
include 'db.php';

$shoe_id = $_POST['shoe_id'];
$size = $_POST['size'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$variation = $_POST['variation'];

// Check if this size already exists for this shoe
$stmt = $conn->prepare("SELECT id FROM shoe_sizes WHERE shoe_id=? AND size=?");
$stmt->bind_param("id", $shoe_id, $size);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Size already exists → update it instead of inserting
    $row = $result->fetch_assoc();
    $update = $conn->prepare("UPDATE shoe_sizes SET price=?, stock=?, variation=? WHERE id=?");
    $update->bind_param("diis", $price, $stock, $variation, $row['id']);
    $update->execute();
} else {
    // Size does not exist → insert new
    $insert = $conn->prepare("INSERT INTO shoe_sizes (shoe_id, size, price, stock, variation) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("iddis", $shoe_id, $size, $price, $stock, $variation);
    $insert->execute();
}

// Redirect back to main inventory page (prevents white screen)
header("Location: index.php"); // replace with your main page
exit;
?>
