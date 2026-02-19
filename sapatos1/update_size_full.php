<?php
include "db.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $id = $_POST['id'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $variation = $_POST['variation'];

    $stmt = $conn->prepare("UPDATE shoe_sizes SET size=?, price=?, stock=?, variation=? WHERE id=?");
    $stmt->bind_param("idisi", $size, $price, $stock, $variation, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>
