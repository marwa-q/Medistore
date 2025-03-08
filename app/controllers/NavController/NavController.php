<?php
require_once __DIR__ . "/../../models/Product.php";


class NavController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new Product($db);
    }

    public function showNavBar()
    {
        $userId = $_COOKIE['id'] ?? "-1"; // Check if cookie exists

        $cats = $this->productModel->getAllCategories();

        // Handle errors safely
        try {
            $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : 0;
        } catch (Exception $e) {
            $favoriteProductIds = 0;
        }

        try {
            $CartProductId = $userId ? $this->productModel->getCartItemCount($userId) : 0;
        } catch (Exception $e) {
            $CartProductId = 0;
        }

        require __DIR__ . "/../../views/Navbar/nav.php"; // عرض الفئات في view
    }
}
