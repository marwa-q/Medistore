<?php
require_once __DIR__ . "/../../config/database.php";

class Order {
    public $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function updateOrderStatus($id, $status) {
        $query = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // يعيد true إذا نجح التحديث، وإلا false
    }

    public function getOrderById($id) {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
