<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *"); // Allows any domain to access this resource
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT"); // Specify allowed HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Specify allowed headers


// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include '../config/Database.php';

$data = json_decode(file_get_contents("php://input"));

// Validate and sanitize input
if (!isset($data->ids) || !is_array($data->ids)) {
    echo json_encode(["message" => "Invalid input"]);
    http_response_code(400);
    exit();
}

// Escape IDs to prevent SQL injection
$ids = array_map(function($id) use ($conn) {
    return $conn->real_escape_string($id);
}, $data->ids);

$ids = implode(',', $ids);

$query = "DELETE FROM products WHERE id IN ($ids)";
if ($conn->query($query) === TRUE) {
    echo json_encode(["message" => "Products deleted successfully"]);
} else {
    echo json_encode(["message" => "Failed to delete products"]);
    http_response_code(500);
}
?>
