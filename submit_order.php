<?php
header("Access-Control-Allow-Origin: *"); // Allow access from any origin
header("Content-Type: application/json"); // Set JSON response format
header("Access-Control-Allow-Methods: POST"); // Allow only POST requests

include 'connect.php';

$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['order'])) {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$order = $input['order']; // Order data received


if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Insert order into database
$stmt = $conn->prepare("INSERT INTO orders (order_data) VALUES (?)");
$order_json = json_encode($order);
$stmt->bind_param("s", $order_json);

if ($stmt->execute()) {
    echo json_encode(["success" => "Order placed successfully!"]);
} else {
    echo json_encode(["error" => "Failed to save order"]);
}

$stmt->close();
$conn->close();
?>