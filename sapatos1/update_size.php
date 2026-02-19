<?php
include "db.php";

$id = $_POST['id'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$conn->query("UPDATE shoe_sizes SET price='$price', stock='$stock' WHERE id=$id");
?>
