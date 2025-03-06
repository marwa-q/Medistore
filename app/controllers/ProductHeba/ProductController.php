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
        $products = $this->productModel->getAllProducts();
        $favoriteProductIds = $this->productModel->getFavoritesByUser("1");
        $cartItems = $this->productModel->getUserCartItems("1");
        $cartItems = $this->productModel->getCart();
        $cartProductIds = $this->productModel->getCartProductIds();
        require __DIR__ . "/../../views/products.php"; // Load the products view
    }

    // public function showCart()
    // {

    //     require_once __DIR__ . '/../../views/Cart/cart.php';
    // }


    public function productsDepentOnCat($id)
    {
        $cartItems = $this->productModel->getUserCartItems("1");
        $cartItems = $this->productModel->getCart();
        $cartProductIds = $this->productModel->getCartProductIds();
        $products = $this->productModel->getProductsByCat($id);
        $favoriteProductIds = $this->productModel->getFavoritesByUser("1");
        require __DIR__ . "/../../views/products.php"; // Load the products view
    }




    public function productDetails($id)
    {
        $product = $this->productModel->getProductById($id);
        $favoriteProductIds = $this->productModel->getFavoritesByUser("1");


        if ($product) {
            require __DIR__ . "/../../views/product_detalis.php";
        } else {
            echo "Product not found!";
            require __DIR__ . "/../../views/products.php";
        }
    }




    public function showAllCategories()
    {
        $cats = $this->productModel->getAllCategories();
        $favoriteProductIds = $this->productModel->getFavoritesByUser("1");
        // print_r($favoriteProductIds);
        $CartProductId = $this->productModel->getCartItemCount("1");
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
        $result = $this->productModel->addProductToFavorites($userId, $productId);
        return $result ? "Product added to favorites" : "Failed to add to favorites";
    }
}
