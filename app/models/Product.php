<?php

class Product
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }



    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get deleted products
    public function getDeletedProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE deleted_at IS NOT NULL");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Soft delete product by setting deleted_at timestamp
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Restore deleted product
    public function restoreProduct($id)
    {
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NULL WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function softDeleteProduct($id)
    {
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
