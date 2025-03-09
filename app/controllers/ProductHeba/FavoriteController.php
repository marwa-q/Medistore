<?php
require_once __DIR__ . "/../../models/Favorite.php";
require_once __DIR__ . "/../../models/Cart.php";


class FavoriteController
{

    private $favoriteModel;
    private $cartModel;

    public function __construct($database)
    {
        $this->favoriteModel = new Favorite($database);
        $this->cartModel = new Cart($database);
    }

    public function addToFavorites()
    {
        // Redirect if user ID is not set
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit(json_encode(["status" => "error", "message" => "Method Not Allowed"]));
        }

        if (!isset($_POST["product_id"]) || empty($_POST["product_id"])) {
            exit(json_encode(["status" => "error", "message" => "Product ID is required"]));
        }

        $productId = $_POST["product_id"];
        $userId = $_COOKIE['id']; // Get user ID from cookie

        if ($this->favoriteModel->addFavorite($userId, $productId)) {
            // Get updated favorite count
            $favoriteCount = $this->favoriteModel->getFavoriteCount($userId);

            exit(json_encode(["status" => "success", "message" => "Added to favorites", "favorite_count" => $favoriteCount]));
        } else {
            exit(json_encode(["status" => "error", "message" => "Failed to add to favorites"]));
        }
    }

    public function removeFromFavorites()
    {
        // Redirect if user ID is not set
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit(json_encode(["status" => "error", "message" => "Method Not Allowed"]));
        }

        if (!isset($_POST["product_id"]) || empty($_POST["product_id"])) {
            exit(json_encode(["status" => "error", "message" => "Product ID is required"]));
        }

        $productId = $_POST["product_id"];
        $userId = $_COOKIE['id']; // Get user ID from cookie

        if ($this->favoriteModel->removeFavorite($userId, $productId)) {
            // Get updated favorite count
            $favoriteCount = $this->favoriteModel->getFavoriteCount($userId);
            exit(json_encode(["status" => "success", "message" => "Removed from favorites", "favorite_count" => $favoriteCount]));
        } else {
            exit(json_encode(["status" => "error", "message" => "Failed to remove from favorites"]));
        }
    }

    // عرض المفضلات الخاصة بالمستخدم
    public function showFavorites()
    {
        // Redirect if user ID is not set
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        $userId = $_COOKIE['id']; // Get user ID from cookie
        $favorites = $this->favoriteModel->getFavoritesByUser($userId);
        $cartProductIds = $this->cartModel->getCart();
        require __DIR__ . "/../../views/Favorite/favorite.php";
    }
}
