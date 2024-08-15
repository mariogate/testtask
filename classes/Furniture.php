<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'Product.php';

class Furniture extends Product {
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length) {
        parent::__construct($sku, $name, $price, 'Furniture');
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function save() {
        include '../config/Database.php';
        $query = "INSERT INTO products (sku, name, price, type, height, width, length) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdsddd", $this->sku, $this->name, $this->price, $this->type, $this->height, $this->width, $this->length);
        $stmt->execute();
    }

    public function delete() {
        // Implement delete logic
    }
}
