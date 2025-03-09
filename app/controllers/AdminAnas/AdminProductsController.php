<?php

require_once __DIR__ . "/../../models/Product.php";

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
        require __DIR__ . "/../../views/admin/adminProducts.php";
    }

    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete']);
        }
    }

    public function saveChangesUpdate($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sanitize and validate input data
            $data = [
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'price' => floatval($_POST['price']),
                'stock' => intval($_POST['stock']),
                'image_url' => htmlspecialchars($_POST['image_url']), // Placeholder for now
            ];
    
            $success = $this->productModel->updateProduct($id, $data);
    
            if ($success) {
                header("Location: /public/products");
                exit;
            } else {
                echo "Failed to update product";
            }
        }
    }
    public function updateProduct($id){
        $product = $this->productModel->getProductById($id);
        require __DIR__. "/../../views/admin/editProduct.php";
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
