<?php

require_once __DIR__ ."/../../models/Cart.php";

class CartController
{
    private $cartModel;

    public function __construct($pdo)
    {
        $this->cartModel = new Cart($pdo);
    }

    public function showCart()
    {
        $cartItems = $this->cartModel->getCart();
        require_once __DIR__ . '/../../views/Cart/cart.php';
    }

    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($product_id) {
                $this->cartModel->addToCart($product_id, $quantity);
            }
            header("Location: /public/cart");
            // echo "<script>window.location.herf = '/public/cart'</script>";
            exit();
        }
    }

    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($product_id) {
                if ($quantity > 0) {
                    $this->cartModel->updateCart($product_id, $quantity);
                } else {
                    $this->cartModel->removeFromCart($product_id);
                }
            }
            header("Location: /public/cart");
            exit();
        }
    }

    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            if ($product_id) {
                $this->cartModel->removeFromCart($product_id);
            }
            header("Location: /public/cart");
            exit();
        }
    }

    public function clearCart()
    {
        $this->cartModel->clearCart();
        header("Location: /public/cart");
        exit();
    }
}
