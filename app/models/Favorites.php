<?php
class Favorite
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    // Add product to favorites
    public function addFavorite($userId, $productId)
    {
        $stmt = $this->db->prepare("INSERT INTO favorites (customer_id, product_id) VALUES (:customer_id, :product_id)");
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Remove product from favorites
    public function removeFavorite($userId, $productId)
    {
        $stmt = $this->db->prepare("DELETE FROM favorites WHERE customer_id = :customer_id AND product_id = :product_id");
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get all favorite product IDs of a user
    public function getFavoriteProductIdsByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT product_id FROM favorites WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Returns an array of product IDs
    }

    // Get favorite product details by user
    public function getFavoritesByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT p.* FROM products p
                                    JOIN favorites f ON p.id = f.product_id
                                    WHERE f.customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
