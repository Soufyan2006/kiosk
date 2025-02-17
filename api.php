<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

// Include the database connection file
include 'connect.php';

// Fetch products from the database
$sql = "SELECT product.product_id, product.name, product.price, product.kcal, images.filename, product.description 
        FROM product
        INNER JOIN images ON product.image_id = images.image_id";

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

// Return JSON response
echo json_encode($products);

// Close the database connection
$conn->close();
?>