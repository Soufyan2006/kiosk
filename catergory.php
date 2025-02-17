<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include 'connect.php';

$sql = "SELECT category_id, name FROM categories";
$result = $conn->query($sql);

$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            "id" => $row["category_id"],
            "name" => $row["name"]
        ];
    }
}

echo json_encode($categories);
$conn->close();
?>