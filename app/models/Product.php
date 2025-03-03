<?php
require_once __DIR__ . "/../../config/database.php";

class Product
{
    public $db;
    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM products");
        if (!$stmt->execute()) {
            die("Database error: " . implode(" | ", $stmt->errorInfo()));
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $price) {
        $query = "UPDATE products SET name = :name, price = :price WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>