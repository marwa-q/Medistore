<?php

require_once __DIR__ . "/../models/Product.php";

class ProductController
{
    private $productModel;

    public function __construct($database)
    {
        $this->productModel = new Product($database);
    }

    // public function showProducts()
    // {
    //     $products = $this->productModel->getAllProducts();
    //     require __DIR__ . "/../views/products.php"; // Load the products view
    // }

    // public function editProduct(){
    //     $ss = $this->productModel->getProductById("4");
    //     require __DIR__ . "/../views/edit_product.php"; // Load the edit_product view
    // }
}
