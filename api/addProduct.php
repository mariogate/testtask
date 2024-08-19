<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *"); // Allows any domain to access this resource
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT"); // Specify allowed HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Specify allowed headers

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Proceed with the rest of your code for handling POST requests
include_once '../classes/DVD.php';
include_once '../classes/Book.php';
include_once '../classes/Furniture.php';

$data = json_decode(file_get_contents("php://input"));

$sku = $data->sku;
$name = $data->name;
$price = $data->price;
$type = $data->type;

if ($type == 'DVD') {
    $size = $data->size;
    $product = new DVD($sku, $name, $price, $size);
} elseif ($type == 'Book') {
    $weight = $data->weight;
    $product = new Book($sku, $name, $price, $weight);
} elseif ($type == 'Furniture') {
    $height = $data->height;
    $width = $data->width;
    $length = $data->length;
    $product = new Furniture($sku, $name, $price, $height, $width, $length);
}

if ($product->save()) {
    echo json_encode(["message" => "Product added successfully"]);
} else {
    echo json_encode(["message" => "Failed to add product"]);
}
?>
