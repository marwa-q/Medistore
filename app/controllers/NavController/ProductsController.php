<?php
require_once __DIR__ . "/../../models/Product.php";


class ProductsController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new Product($db);
    }

    public function showProductByCategory($id)
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

        if ($id === null) {
            $products = $this->productModel->getAllProducts();
        } else {
            $products = $this->productModel->getProductsByCat($id);
        }

        require __DIR__ . "/../../views/Products/products.php";
    }
}
