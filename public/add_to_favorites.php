<?php
session_start();
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../controllers/FavoriteController.php";

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please log in to add to favorites']);
    exit;
}

$userId = $_SESSION['user_id'];
$productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;

if ($productId) {
    $favoriteController = new FavoriteController($pdo);
    echo $favoriteController->addToFavorites($userId, $productId);
} else {
    echo json_encode(['success' => false, 'message' => 'Product ID not provided']);
}
?>
