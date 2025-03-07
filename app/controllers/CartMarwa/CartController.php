<?php

require_once __DIR__ . "/../../models/Cart.php";

class CartController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new Cart($pdo);
    }

    public function showCart()
    {
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        $cartItems = $this->cartModel->getCart($_COOKIE['id']);
        require_once __DIR__ . '/../../views/Cart/cart.php';
    }

    public function updateCart()
    {
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($product_id) {
                if ($quantity > 0) {
                    $this->cartModel->updateCart($product_id, $quantity);
                } else {
                    $this->cartModel->removeFromCart($product_id);
                }

                // ✅ Get updated cart count
                $Count = $this->cartModel->getCartItemCount($_COOKIE['id']);
                $cartCount = count($Count);

                // ✅ Return JSON response instead of redirecting
                exit(json_encode([
                    "status" => "success",
                    "message" => "Cart updated",
                    "cart_count" => $cartCount
                ]));
            }

            exit(json_encode([
                "status" => "error",
                "message" => "Product ID is required"
            ]));
        }

        http_response_code(405);
        exit(json_encode([
            "status" => "error",
            "message" => "Method Not Allowed"
        ]));
    }

    public function addToCart()
    {
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($product_id) {
                $this->cartModel->addToCart($product_id, $quantity);

                // ✅ Get updated cart count
                $Count = $this->cartModel->getCartItemCount($_COOKIE['id']);
                $cartCount = count($Count);

                // Return JSON response
                exit(json_encode([
                    "status" => "success",
                    "message" => "Added to cart",
                    "cart_count" => $cartCount
                ]));
            }

            exit(json_encode([
                "status" => "error",
                "message" => "Product ID is required"
            ]));
        }

        http_response_code(405);
        exit(json_encode([
            "status" => "error",
            "message" => "Method Not Allowed"
        ]));
    }

    public function removeFromCart()
    {
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;

            if ($product_id) {
                $this->cartModel->removeFromCart($product_id);

                // ✅ Get updated cart count
                $Count = $this->cartModel->getCartItemCount($_COOKIE['id']);
                $cartCount = count($Count);

                // Return JSON response
                exit(json_encode([
                    "status" => "success",
                    "message" => "Removed from cart",
                    "cart_count" => $cartCount
                ]));
            }

            exit(json_encode([
                "status" => "error",
                "message" => "Product ID is required"
            ]));
        }

        http_response_code(405);
        exit(json_encode([
            "status" => "error",
            "message" => "Method Not Allowed"
        ]));
    }

    public function clearCart()
    {
        if (!isset($_COOKIE['id'])) {
            header("Location: /public/login");
            exit();
        }

        $this->cartModel->clearCart($_COOKIE['id']);
        header("Location: /public/cart");
        exit();
    }
}
