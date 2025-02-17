<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include 'connect.php';

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

$sql = "SELECT product.product_id, product.name, product.price, product.kcal, images.filename, product.description 
        FROM product
        INNER JOIN images ON product.image_id = images.image_id
        WHERE product.category_id = $category_id";

$result = $conn->query($sql);

$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            "id" => $row["product_id"],
            "name" => $row["name"],
            "price" => $row["price"],
            "kcal" => $row["kcal"],
            "image" => $row["filename"],
            "description" => $row["description"]
        ];
    }
}

echo json_encode($products);
$conn->close();
?>