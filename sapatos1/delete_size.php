<?php
include "db.php";

if(isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM shoe_sizes WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ".$_SERVER['HTTP_REFERER']); // back to the previous page
exit;
?>
