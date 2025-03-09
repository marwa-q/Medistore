<?php

require_once __DIR__ . "/../../models/Product.php";
require_once __DIR__ . "/../../models/Order.php";
require_once __DIR__ . "/../../models/Cart.php";
require_once __DIR__ . "/../../models/Copon.php";

class OrderController
{
    private $couponModel; // Assuming a separate Coupon model exists
    private $orderModel;
    private $cartModel;
    private $productModel;

    public function __construct($db)
    {
        $this->orderModel = new Order($db);
        $this->cartModel = new Cart($db);
        $this->productModel = new Product($db);
        $this->couponModel = new Copon($db); // Assuming a separate Coupon model exists
    }

    public function checkout()
    {
        if (isset($_COOKIE["id"])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $customerId = $_COOKIE['id']; // Fixed as per production setup
                $paymentMethod = $_POST['payment_method'];
                $address = $_POST['address'];
                $couponCode = $_POST['coupon'] ?? null; // Get the coupon code from the form

                // Validate input
                if (empty($paymentMethod) || empty($address)) {
                    $_SESSION['error'] = "All fields are required!";
                    header("Location: /public/checkout");
                    exit;
                }

                // Fetch cart items
                $cartItems = $this->cartModel->getCartItems($customerId);
                if (empty($cartItems)) {
                    $_SESSION['error'] = "Your cart is empty!";
                    header("Location: /public/checkout");
                    exit;
                }

                // Calculate total amount
                $totalAmount = 0;
                foreach ($cartItems as $item) {
                    $product = $this->productModel->getProductById($item['product_id']);
                    $totalAmount += $product['price'] * $item['quantity'];
                }

                // Apply coupon if provided
                $discountValue = 0; // Initialize discount value
                if ($couponCode) {
                    // Step 1: Validate the coupon
                    $validationResult = $this->couponModel->validateCoupon($couponCode, $customerId);
                    if ($validationResult['success']) {
                        // Apply the discount
                        $discountValue = $validationResult['coupon']['discount_value'];
                        $totalAmount -= (($totalAmount * $discountValue) / 100);
                    }
                }

                // Create order with the discounted total
                $orderId = $this->orderModel->createOrder($customerId, ($totalAmount + 5));

                // Record coupon usage if a coupon was applied
                if ($couponCode && $validationResult['success']) {
                    $this->couponModel->decrementCouponUsage(
                        $validationResult['coupon']['id'], // coupon_id
                        $orderId, // order_id
                        $customerId // customer_id
                    );
                }

                // Add order items
                foreach ($cartItems as $item) {
                    $product = $this->productModel->getProductById($item['product_id']);
                    $this->orderModel->addOrderItem($orderId, $item['product_id'], $item['quantity'], $product['price']);
                }

                // Clear cart after order is placed
                $this->orderModel->clearCart($customerId);

                // Redirect to thank you page
                header("Location: /public/thank-you");
                exit;
            }
        } else {
            header("Location: /public/login");
            exit;
        }

        $cartItems = $this->cartModel->getCartItems($_COOKIE['id']);
        require_once __DIR__ . '/../../views/Checkout/checkout.php';
    }
}
