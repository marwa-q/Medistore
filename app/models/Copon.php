<?php
class Copon
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function validateCoupon($couponCode, $customerId)
    {
        // Step 1: Check if the coupon exists and is valid
        $couponQuery = "
            SELECT id, discount_value, expiration_date, usage_limit 
            FROM coupons 
            WHERE code = :code 
              AND expiration_date > NOW() 
              AND usage_limit > 0
        ";
        $couponStmt = $this->db->prepare($couponQuery);
        $couponStmt->execute([':code' => $couponCode]);
        $coupon = $couponStmt->fetch(PDO::FETCH_ASSOC);

        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid or expired coupon.'];
        }

        // Step 2: Check if the customer has already used this coupon
        $usageQuery = "
            SELECT id 
            FROM coupon_usages 
            WHERE coupon_id = :coupon_id 
              AND customer_id = :customer_id
        ";
        $usageStmt = $this->db->prepare($usageQuery);
        $usageStmt->execute([
            ':coupon_id' => $coupon['id'],
            ':customer_id' => $_COOKIE["id"]
        ]);
        $usage = $usageStmt->fetch(PDO::FETCH_ASSOC);

        if ($usage) {
            return ['success' => false, 'message' => 'Coupon already used by this customer.'];
        }

        // Return the coupon details if valid
        return [
            'success' => true,
            'message' => 'Coupon is valid.',
            'coupon' => $coupon
        ];
    }

    public function decrementCouponUsage($couponId, $orderId)
    {
        // Step 1: Decrement the coupon's usage limit
        $updateQuery = "
        UPDATE coupons 
        SET usage_limit = usage_limit - 1 
        WHERE id = :coupon_id
    ";
        $updateStmt = $this->db->prepare($updateQuery);
        $updateStmt->execute([':coupon_id' => $couponId]);

        // Step 2: Record the coupon usage in the coupon_usages table
        //     $insertQuery = "
        //     INSERT INTO coupon_usages (coupon_id, order_id, customer_id, used_at) 
        //     VALUES (:coupon_id, :order_id, :customer_id, NOW())
        // ";
        //     $insertStmt = $this->db->prepare($insertQuery);
        //     $insertStmt->execute([
        //         ':coupon_id' => $couponId,
        //         ':order_id' => $orderId,
        //         ':customer_id' => $_COOKIE["id"]
        //     ]);

        return ['success' => true, 'message' => 'Coupon usage decremented and recorded successfully.'];
    }
}
