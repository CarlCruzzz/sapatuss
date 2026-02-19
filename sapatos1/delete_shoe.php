<?php
include "db.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $id = $_POST['id'];

    // Delete sizes first
    $conn->query("DELETE FROM shoe_sizes WHERE shoe_id=$id");

    // Delete shoe
    $conn->query("DELETE FROM shoes WHERE id=$id");

    header("Location: index.php");
}
?>
