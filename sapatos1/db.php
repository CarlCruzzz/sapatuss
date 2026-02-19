<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sapatos_inventory";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(["status" => "error", "msg" => "Connection failed: " . $conn->connect_error]);
    exit;
}
?>
