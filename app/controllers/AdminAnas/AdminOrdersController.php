<?php

require_once __DIR__ . "/../../models/Admin.php";

class AdminOrdersController
{

    private $adminSchema;

    public function __construct($database)
    {
        $this->adminSchema = new Admin($database);
    }

    public function getAllGeneralOrders()
    {
        $orders = $this->adminSchema->showAllTheOrdersGeneral();
        require __DIR__ . "/../../views/Admin/adminOrdersGeneral.php";
    }

    public function getSpecificOrder($id)
    {
        $order = $this->adminSchema->getOrderById($id);
        $items = $this->adminSchema->getOrderItems($id);
        $logs = $this->adminSchema->getOrderEditLogs($id) ?? []; // Fetch logs here

        require __DIR__ . "/../../views/admin/adminOrderItems.php"; // Load the view
    }


    public function editOrder($orderId)
    {
        $order = $this->adminSchema->getOrderById($orderId);
        $items = $this->adminSchema->getOrderItems($orderId);

        require __DIR__ . "/../../views/admin/editOrder.php"; // Load the edit order page
    }

    public function updateOrder($id)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $quantities = $_POST["quantities"] ?? [];
            $status = $_POST["status"] ?? 'pending'; // Default to 'pending' if status is not provided

            foreach ($quantities as $productId => $quantity) {
                $this->adminSchema->updateOrderItemQuantity($id, $productId, $quantity, $status);
            }

            header("Location: /public/orders");
            exit();
        }
    }


    public function deleteOrderItem($orderId, $productId)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
            return;
        }

        $deleted = $this->adminSchema->deleteOrderItem($orderId, $productId);

        if ($deleted) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete item"]);
        }
    }
}
