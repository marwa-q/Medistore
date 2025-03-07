<?php

class Cart
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCartItemCount($user_id)
    {
        $stmt = $this->db->prepare("SELECT product_id, quantity FROM carts WHERE customer_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
    }



    public function addToCart($product_id, $quantity)
    {
        $customer_id = $_COOKIE['id'];
        $stmt = $this->db->prepare("SELECT id, quantity FROM carts WHERE customer_id = ? AND product_id = ?");
        $stmt->execute([$customer_id, $product_id]);
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            $newQuantity = $cartItem['quantity'] + $quantity;
            $stmt = $this->db->prepare("UPDATE carts SET quantity = ?, updated_at = NOW() WHERE id = ?");
            return $stmt->execute([$newQuantity, $cartItem['id']]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO carts (customer_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
            return $stmt->execute([$customer_id, $product_id, $quantity]);
        }
    }

    public function getCart()
    {
        $customer_id = $_COOKIE['id'];
        $stmt = $this->db->prepare("SELECT carts.*, products.name, products.price, products.image_url 
                            FROM carts 
                            JOIN products ON carts.product_id = products.id 
                            WHERE customer_id = ?");
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll();
    }

    public function updateCart($product_id, $quantity)
    {
        $customer_id = $_COOKIE['id'];
        if ($quantity > 0) {
            $stmt = $this->db->prepare("UPDATE carts SET quantity = ?, updated_at = NOW() WHERE customer_id = ? AND product_id = ?");
            return $stmt->execute([$quantity, $customer_id, $product_id]);
        } else {
            return $this->removeFromCart($product_id);
        }
    }

    public function removeFromCart($product_id)
    {
        $customer_id = $_COOKIE['id'];
        $stmt = $this->db->prepare("DELETE FROM carts WHERE customer_id = ? AND product_id = ?");
        return $stmt->execute([$customer_id, $product_id]);
    }

    public function clearCart()
    {
        $customer_id = $_COOKIE['id'];
        $stmt = $this->db->prepare("DELETE FROM carts WHERE customer_id = ?");
        return $stmt->execute([$customer_id]);
    }

    public function getCartItems($customerId)
    {
        $sql = "SELECT c.id, c.product_id, c.quantity, p.name, p.price 
            FROM carts c
            JOIN products p ON c.product_id = p.id
            WHERE c.customer_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$customerId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
