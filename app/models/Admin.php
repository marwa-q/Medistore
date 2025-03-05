<?php
require_once __DIR__ . "/_functions.php";


class Admin
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function showAllTheOrdersGeneral()
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("
                SELECT orders.id, orders.customer_id, customers.email AS customer_email, 
                       orders.total_amount, orders.status, 
                       orders.created_at, orders.updated_at
                FROM orders
                JOIN customers ON orders.customer_id = customers.id
            ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($id)
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   

    public function getOrderItems($orderId)
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("
            SELECT order_items.id, order_items.product_id, products.name AS product_name, 
                   order_items.quantity, order_items.price, order_items.created_at 
            FROM order_items
            JOIN products ON order_items.product_id = products.id
            WHERE order_items.order_id = :order_id
        ");
        $stmt->bindParam(":order_id", $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderEditLogs($orderId)
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("SELECT * FROM order_edit_logs WHERE order_id = :order_id ORDER BY edited_at DESC");
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }



   

    public function deleteOrderItem($orderId, $productId)
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("DELETE FROM order_items WHERE order_id = :order_id AND product_id = :product_id");
        $stmt->execute([':order_id' => $orderId, ':product_id' => $productId]);

        // Check if deletion was successful
        if ($stmt->rowCount() > 0) {
            // Log the action
            $logStmt = $this->db->prepare("INSERT INTO order_edit_logs (order_id, action, details) VALUES (:order_id, 'Deleted Product', :details)");
            $logStmt->execute([
                ':order_id' => $orderId,
                ':details' => "Deleted product with ID $productId from order $orderId"
            ]);
            return true; // Success
        }

        return false; // No row deleted
    }


    public function updateOrderItemQuantity($orderId, $productId, $newQuantity)
    {
        echo Func::checkRegularAdmin();
        $stmt = $this->db->prepare("UPDATE order_items SET quantity = :quantity WHERE order_id = :order_id AND product_id = :product_id");
        $stmt->execute([':quantity' => $newQuantity, ':order_id' => $orderId, ':product_id' => $productId]);

        // Log the action
        $logStmt = $this->db->prepare("INSERT INTO order_edit_logs (order_id, action, details) VALUES (:order_id, 'Updated Quantity', :details)");
        $logStmt->execute([
            ':order_id' => $orderId,
            ':details' => "Updated product ID $productId to quantity $newQuantity in order $orderId"
        ]);
    }
}
