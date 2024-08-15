<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'Product.php';

class DVD extends Product {
    private $size;

    public function __construct($sku, $name, $price, $size) {
        parent::__construct($sku, $name, $price, 'DVD');
        $this->size = $size;
    }

    public function save() {
        include '../config/Database.php';
        $query = "INSERT INTO products (sku, name, price, type, size) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdsi", $this->sku, $this->name, $this->price, $this->type, $this->size);
        $stmt->execute();
    }

    public function delete() {
        // Implement delete logic
    }
}