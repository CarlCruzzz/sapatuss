<?php
include "db.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';

$query = "SELECT * FROM shoes WHERE brand LIKE '%$search%' OR model LIKE '%$search%' OR item_id LIKE '%$search%'";

switch($sort){
    case "date_desc": $query .= " ORDER BY created_at DESC"; break;
    case "date_asc": $query .= " ORDER BY created_at ASC"; break;
    case "az": $query .= " ORDER BY brand ASC"; break;
}

$result = $conn->query($query);
$shoes = [];

while($row = $result->fetch_assoc()){
    $sizesRes = $conn->query("
        SELECT ss.id, ss.size, ss.price, 
               IFNULL(st.quantity,0) AS stock
        FROM shoe_sizes ss
        LEFT JOIN shoe_stocks st ON st.size_id=ss.id
        WHERE ss.shoe_id=".$row['id']."
        ORDER BY ss.size ASC
    ");

    $sizes = [];
    while($size = $sizesRes->fetch_assoc()){
        $size['stock_label'] = $size['stock'] == 0 ? "NO STOCK" : $size['stock'] . " stock(s)";
        $sizes[] = $size;
    }

    $row['sizes'] = $sizes;
    $row['image'] = base64_encode($row['image']);
    $shoes[] = $row;
}

echo json_encode($shoes);
?>
