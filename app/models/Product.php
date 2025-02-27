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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id){
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}




?>


