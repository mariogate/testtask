<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    error_log("OPTIONS request received");
    http_response_code(200);
    exit();
}

include '../config/Database.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->ids) || !is_array($data->ids) || empty($data->ids)) {
    echo json_encode(["message" => "Invalid input"]);
    http_response_code(400);
    exit();
}

$placeholders = implode(',', array_fill(0, count($data->ids), '?'));

$query = "DELETE FROM products WHERE id IN ($placeholders)";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param(str_repeat('i', count($data->ids)), ...$data->ids);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Products deleted successfully"]);
        http_response_code(200);
    } else {
        echo json_encode(["message" => "Failed to delete products", "error" => $stmt->error]);
        http_response_code(500);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Failed to prepare statement", "error" => $conn->error]);
    http_response_code(500);
}

$conn->close();
?>