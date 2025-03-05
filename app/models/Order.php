<?php


class Order
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createOrder($customerId, $totalAmount, $status = 'pending')
    {
        $query = "INSERT INTO orders (customer_id, total_amount, status, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$customerId, $totalAmount, $status]);

        return $this->db->lastInsertId(); // Get the last inserted order ID
    }

    public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$orderId, $productId, $quantity, $price]);
    }

    public function clearCart($customerId)
    {
        $query = "DELETE FROM carts WHERE customer_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$customerId]);
    }
}
