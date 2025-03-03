<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/Product.php";
if (!isset($pdo)) {
    die("Error: Database connection is not initialized.");
}

class ProductController {
    private $product;

    public function __construct($database) {
        $this->product = new Product($database);
    }

    public function showProducts() {
        $products = $this->product->getAllProducts();
        require __DIR__ . "/../views/products.php";
    }

    public function editProduct($id) {
        $product = $this->product->getProductById($id);
        if ($product) {
            require_once __DIR__ . "/../views/edit.php";
        } else {
            header("Location: products.php?error=Product not found");
            exit();
        }
    }

    public function updateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $result = $this->product->updateProduct($id, $name, $price);
                if ($result) {
                    header("Location: products.php?message=Product updated successfully");
                } else {
                    header("Location: products.php?error=Failed to update product");
                }
            } else {
                header("Location: products.php?error=Invalid request");
            }
            exit();
        }
    
    }
}
// For testing purposes
$productController = new ProductController($pdo);
$productController->showProducts();
?>