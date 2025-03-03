<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/Order.php";

class OrderController {
    private $order;

    public function __construct($database) {
        $this->order = new Order($database);
    }

    public function editOrder() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $order = $this->order->getOrderById($id);
            if ($order) {
                require_once __DIR__ . "/../views/edit_order.php";
            } else {
                header("Location: ../views/orders.php?error=Order not found");
                exit();
            }
        } else {
            header("Location: ../views/orders.php?error=Invalid request");
            exit();
        }
    }
    
    public function updateOrder() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $result = $this->order->updateOrderStatus($id, $status);
            if ($result) {
                header("Location: ../views/orders.php?message=Order updated successfully");
            } else {
                header("Location: ../views/orders.php?error=Failed to update order");
            }
        } else {
            header("Location: ../views/orders.php?error=Invalid request");
        }
        exit();
    }
}
?>
