<?php
require_once __DIR__ . "/../../models/Copon.php";


class CoponController
{
    private $couponModel;

    public function __construct($db)
    {
        $this->couponModel = new Copon($db);
    }

    // In your controller
    public function applyCoupon()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $couponCode = $request['coupon_code'] ?? null;
        $customerId = $_COOKIE['id'] ?? null;

        if (!$couponCode || !$customerId) {
            echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
            return;
        }

        // Validate the coupon
        $validationResult = $this->couponModel->validateCoupon($couponCode, $customerId);

        if (!$validationResult['success']) {
            echo json_encode($validationResult);
            return;
        }

        // Return the coupon details if valid
        echo json_encode([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'discount_value' => $validationResult['coupon']['discount_value']
        ]);
    }
}
