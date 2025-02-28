<?php

require_once __DIR__ . "/../models/Product.php";

class AdminProductsController
{

    private $productModel;

    public function __construct($database)
    {
        $this->productModel = new Product($database);
    }

    public function getProducts()
    {
        $products = $this->productModel->getAllProducts(); // Active products
        $deletedProducts = $this->productModel->getDeletedProducts(); // Deleted products
        require __DIR__ . "/../views/admin/adminProducts.php";
    }

    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete']);
        }
    }

    public function restore($id)
    {
        if ($this->productModel->restoreProduct($id)) {
            header("Location: public/products"); // Redirect to products page
            exit;
        } else {
            echo "Failed to restore product.";
        }
    }

    public function deleteProduct($id)
    {
        $success = $this->productModel->softDeleteProduct($id);
        if ($success) {
            header("Location: public/products");
            exit;
        } else {
            echo "Failed to delete product";
        }
    }
}
