<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'Product.php';

class Book extends Product {
    private $weight;

    public function __construct($sku, $name, $price, $weight) {
        parent::__construct($sku, $name, $price, 'Book');
        $this->weight = $weight;
    }

    public function save() {
        include '../config/Database.php';
        $query = "INSERT INTO products (sku, name, price, type, weight) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdsi", $this->sku, $this->name, $this->price, $this->type, $this->weight);
        $stmt->execute();
    }

    public function delete() {
        // Implement delete logic
    }
}
