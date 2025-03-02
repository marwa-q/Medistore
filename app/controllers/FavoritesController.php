<?php
require_once __DIR__ . "/../models/Favorites.php";

class FavoriteController
{

    private $favoriteModel;

    public function __construct($database)
    {
        $this->favoriteModel = new Favorite($database);
    }

    // إضافة المنتج إلى المفضلة
    // public function addToFavorites($userId, $productId)
    // {
    //     if ($this->favoriteModel->addFavorite($userId, $productId)) {
    //         return json_encode(['success' => true, 'message' => 'Added to favorites!']);
    //     } else {
    //         return json_encode(['success' => false, 'message' => 'Error adding to favorites']);
    //     }
    // }

    public function addToFavorites()
    {
        header('Content-Type: application/json');

        // Debugging
        error_log("addToFavorites function called");

        // Get JSON data from request body
        $data = $_POST["product_id"];

        if (!$data) {
            error_log("Failed to decode JSON");
            echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
            exit;
        }

        if (!isset($data)) {
            error_log("Product ID missing");
            echo json_encode(['success' => false, 'message' => 'Product ID is required']);
            exit;
        }

        $userId = "1"; // Assuming user ID is stored in session
        $productId = $data; // Use JSON data, not $_POST

        if ($this->favoriteModel->addFavorite($userId, $productId)) {
            error_log("Added to favorites successfully");
            echo json_encode(['success' => true, 'message' => 'Added to favorites!']);
            header("Location: public/favorites");
        } else {
            error_log("Failed to add favorite");
            header("Location: public/");
            echo json_encode(['success' => false, 'message' => 'Error adding to favorites']);
        }
        exit;
    }


    public function removeFromFavorites()
    {
        // if (!isset($_SESSION['user_id'])) {
        //     echo json_encode(['success' => false, 'message' => 'User not logged in']);
        //     return;
        // }

        $userId = "1";
        $data = $_POST["product_id"];

        if (!isset($data)) {
            echo json_encode(['success' => false, 'message' => 'Product ID is required']);
            return;
        }

        $productId = $data;

        if ($this->favoriteModel->removeFavorite($userId, $productId)) {
            echo json_encode(['success' => true, 'message' => 'Removed from favorites!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error removing from favorites']);
        }
    }


    // عرض المفضلات الخاصة بالمستخدم
    public function showFavorites($userId)
    {
        $favorites = $this->favoriteModel->getFavoritesByUser($userId);
        require __DIR__ . "/../views/favorites.php";
    }
}
