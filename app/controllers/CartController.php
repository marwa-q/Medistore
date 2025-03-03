<?php
require_once __DIR__ . "/../models/Cart.php";
require_once __DIR__ . "/../models/Product.php";

class CartController
{
    private $cartModel;
    public function __construct($pdo)
    {
        $this->cartModel = new Cart($pdo);
    }

    public function showCartItems() {
        $cartItems = $this->cartModel->getCartItems(1 , 1);
        require __DIR__ . "/../views/cart.php";
    }


    public function addToCart()
    {
        header('Content-Type: application/json');

        // Debugging
        error_log("addToCart function called");

        // Check if product_id is set in POST request
        if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
            error_log("Product ID missing or empty");
            echo json_encode(['success' => false, 'message' => 'Product ID is required']);
            exit;
        }

        $userId = "1"; // Ideally, fetch this from the session
        $productId = $_POST['product_id'];

        // Debugging logs
        error_log("User ID: $userId, Product ID: $productId");

        // Attempt to add product to cart
        if ($this->cartModel->addToCart($userId, $productId)) {
            error_log("Added to cart successfully");

            // Redirect after adding to cart (for non-AJAX)
            // header("Location: $baseUrl/cart");
            exit;
        } else {
            error_log("Failed to add to cart");
            echo json_encode(['success' => false, 'message' => 'Error adding to cart']);
            exit;
        }
    }



    // public function addToCart() {
    //     header('Content-Type: application/json');

    //     // Debugging
    //     error_log("addToCart function called");

    //     // Get JSON data from request body
    //     $data = $_POST["product_id"];

    //     if (!$data) {
    //         error_log("Failed to decode JSON");
    //         echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    //         exit;
    //     }

    //     if (!isset($data)) {
    //         error_log("Product ID missing");
    //         echo json_encode(['success' => false, 'message' => 'Product ID is required']);
    //         exit;
    //     }

    //     $userId = "1"; // Assuming user ID is stored in session
    //     $productId = $data; // Use JSON data, not $_POST

    //     if ($this->cart->addToCart($userId, $productId)) {
    //         error_log("Added to cart successfully");
    //         echo json_encode(['success' => true, 'message' => 'Added to cart!']);
    //         header("Location: public/cart");
    //     } else {
    //         error_log("Failed to add cart");
    //         header("Location: public/");
    //         echo json_encode(['success' => false, 'message' => 'Error adding to cart']);
    //     }
    //     exit;
    // }


    public function updateCartItem()
    {
        $userId = "1";
        $data = $_POST["product_id"];

        if (!isset($data)) {
            echo json_encode(['success' => false, 'message' => 'Product ID is required']);
            return;
        }

        $productId = $data;

        if ($this->cartModel->updateCart($userId, $productId)) {
            echo json_encode(['success' => true, 'message' => 'Removed from cart!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error removing from cart']);
        }
    }
}
