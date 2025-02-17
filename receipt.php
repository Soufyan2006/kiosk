<?php
include 'connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO order_product (product_id, product_name,price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $product_id, $product_name, $price);

    if ($stmt->execute()) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>