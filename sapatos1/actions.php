<?php
include "db.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){

    // ================= ADD NEW SHOE =================
    if(isset($_POST['action']) && $_POST['action']=="add_shoe"){
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $item_id = $_POST['item_id'];

        // Handle image
        if(isset($_FILES['image']) && $_FILES['image']['error']==0){
            $imgData = file_get_contents($_FILES['image']['tmp_name']);
            $imgType = $_FILES['image']['type'];
        } else { $imgData = null; $imgType = null; }

        $stmt = $conn->prepare("INSERT INTO shoes (brand, model, item_id, image, image_type, created_at) VALUES (?,?,?,?,?,NOW())");
        $stmt->bind_param("ssbbs", $brand, $model, $item_id, $imgData, $imgType);
        $stmt->execute();
        $shoe_id = $stmt->insert_id;

        // Insert sizes
        foreach($_POST['size'] as $i => $s){
            $variation = $_POST['variation'][$i];
            $stmt2 = $conn->prepare("INSERT INTO shoe_sizes (shoe_id, size, price, stock, variation) VALUES (?,?,?,?,?)");
            $stmt2->bind_param("iddis", $shoe_id, $_POST['size'][$i], $_POST['price'][$i], $_POST['stock'][$i], $variation);
            $stmt2->execute();
        }

        header("Location: index.php");
        exit();
    }

    // ================= UPDATE SIZE =================
    if(isset($_POST['action']) && $_POST['action']=="update_size"){
        $id = $_POST['id'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $variation = $_POST['variation'];

        $stmt = $conn->prepare("UPDATE shoe_sizes SET size=?, price=?, stock=?, variation=? WHERE id=?");
        $stmt->bind_param("ddisi", $size, $price, $stock, $variation, $id);
        $stmt->execute();

        header("Location: index.php");
        exit();
    }

    // ================= ADD SIZE TO EXISTING SHOE =================
    if(isset($_POST['action']) && $_POST['action']=="add_size_existing"){
        $shoe_id = $_POST['shoe_id'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
         $variation = $_POST['variation'];

        $stmt = $conn->prepare("INSERT INTO shoe_sizes (shoe_id, size, price, stock, variation) VALUES (?,?,?,?,?)");
        $stmt->bind_param("iddis", $shoe_id, $size, $price, $stock, $variation);
        $stmt->execute();

        header("Location: index.php");
        exit();
    }

    // ================= DELETE SHOE =================
    if(isset($_POST['action']) && $_POST['action']=="delete_shoe"){
        $id = $_POST['id'];

        $conn->query("DELETE FROM shoe_sizes WHERE shoe_id=$id");
        $conn->query("DELETE FROM shoes WHERE id=$id");

        header("Location: index.php");
        exit();
    }

}
?>
