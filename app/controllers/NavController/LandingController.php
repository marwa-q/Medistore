<?php
require_once __DIR__ . "/../../models/Product.php";


class LandingController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new Product($db);
    }

    public function showLandingPage()
    {
        require __DIR__ . "/../../views/LandingPage/landing.php"; // عرض الصفحة الر��يسية في view
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


    public function showProductsBestSellers()
    {
        $userId = $_COOKIE['id'] ?? null; // Check if cookie exists

        try {
            $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : [];
        } catch (Exception $e) {
            $favoriteProductIds = [];
        }

        try {
            $cartProductIds = $userId ? $this->productModel->getCartProductIds($userId) : [];
        } catch (Exception $e) {
            $cartProductIds = [];
        }

        // try {
        //     $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : [];
        // } catch (Exception $e) {
        //     $favoriteProductIds = [];
        // }

        // try {
        //     $cartProductIds = $userId ? $this->productModel->getCartItemCount($userId) : [];
        // } catch (Exception $e) {
        //     $cartProductIds = [];
        // }
        try {
            $cartItems = $userId ? $this->productModel->getCart($userId) : [];
        } catch (Exception $e) {
            $cartItems = [];
        }
        $bestSellers = $this->productModel->getAllProducts();
        $allProducts = $this->productModel->getAllProducts();
        $clothing = $this->productModel->getProductsByCat("1");

        $products = array_slice($bestSellers, 12, 3);
        $last = array_slice($allProducts, 4, 8);
        $clothes = array_slice($clothing, 0, 3);

        require __DIR__ . "/../../views/LandingPage/bestSeller.php"; // عرض الفئات في view
    }
}
