<?php

require_once __DIR__ . "/../../models/Product.php";

class ProductController
{
    private $productModel;


    public function __construct($database)
    {
        $this->productModel = new Product($database);
    }

    public function showProducts()
    {
        $userId = $_COOKIE['id'] ?? null; // Check if cookie exists

        try {
            $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : [];
        } catch (Exception $e) {
            $favoriteProductIds = [];
        }

        try {
            $cartProductIds = $userId ? $this->productModel->getCartItemCount($userId) : [];
        } catch (Exception $e) {
            $cartProductIds = [];
        }

        try {
            $cartItems = $userId ? $this->productModel->getCart($userId) : [];
        } catch (Exception $e) {
            $cartItems = [];
        }

        $products = $this->productModel->getAllProducts();
        // $cartItems = $this->productModel->getCart();
        require __DIR__ . "/../../views/products.php"; // Load the products view
    }

    // public function showCart()
    // {

    //     require_once __DIR__ . '/../../views/Cart/cart.php';
    // }


    public function productsDepentOnCat($id)
    {
        $userId = $_COOKIE['id'] ?? null; // Check if cookie exists

        try {
            $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : [];
        } catch (Exception $e) {
            $favoriteProductIds = [];
        }

        try {
            $cartProductIds = $userId ? $this->productModel->getCartItemCount($userId) : [];
        } catch (Exception $e) {
            $cartProductIds = [];
        }

        try {
            $cartItems = $userId ? $this->productModel->getCart($userId) : [];
        } catch (Exception $e) {
            $cartItems = [];
        }


        $products = $this->productModel->getProductsByCat($id);

        require __DIR__ . "/../../views/products.php"; // Load the products view
    }




    public function productDetails($id)
    {

        
        $product = $this->productModel->getProductById($id);
        $favoriteProductIds = $this->productModel->getFavoritesByUser($_COOKIE['id'] ?? null);


        if ($product) {
            require __DIR__ . "/../../views/product_detalis.php";
        } else {
            echo "Product not found!";
            require __DIR__ . "/../../views/products.php";
        }
    }




    public function showAllCategories()
    {
        
        $userId = $_COOKIE['id'] ?? null; // Check if cookie exists

        try {
            $favoriteProductIds = $userId ? $this->productModel->getFavoritesByUser($userId) : [];
        } catch (Exception $e) {
            $favoriteProductIds = [];
        }

        try {
            $CartProductId = $userId ? $this->productModel->getCartItemCount($userId) : [];
        } catch (Exception $e) {
            $CartProductId = [];
        }

        $cats = $this->productModel->getAllCategories();
        // $favoriteProductIds = $this->productModel->getFavoritesByUser($_COOKIE['id'] ?? null);
        // print_r($favoriteProductIds);
        // $CartProductId = $this->productModel->getCartItemCount($_COOKIE['id'] ?? null);
        // $CartProductId = count($CartProductId);
        // print_r($CartProductId);
        // print_r($favoriteProductIds);

        require __DIR__ . "/../../views/category.php"; // عرض الف��ات في view
    }


    public function showCategory($categoryId = null)
    {
        $products = $this->productModel->getProductsByCategory($categoryId); // استخدام نموذج المنتجات للحصول على المنتجات حسب الفئة
        require __DIR__ . "/../../views/category.php"; // عرض المنتجات في view
    }
    public function addToFavorites($userId, $productId)
    {
        $result = $this->productModel->addProductToFavorites($_COOKIE['id'] ?? null, $productId);
        return $result ? "Product added to favorites" : "Failed to add to favorites";
    }
}
