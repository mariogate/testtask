<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Include database connection
include '../config/Database.php';

// Check if the connection was successful
if (!$conn) {
    // Respond with a 500 Internal Server Error if the connection fails
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit();
}

// Query the database
$query = "SELECT * FROM products ORDER BY id";
$result = $conn->query($query);

// Check if the query was successful
if ($result === false) {
    // Respond with a 500 Internal Server Error if the query fails
    http_response_code(500);
    echo json_encode(['error' => 'Database query failed: ' . $conn->error]);
    exit();
}

// Fetch the data and build the array
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Free the result set
$result->free();

// Output the products as JSON
echo json_encode($products);

// Close the database connection
$conn->close();
?>
