<?php

class Cart {
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }


//     public function getCartItems($userId, $productId) {
//     try {
//         $stmt = $this->db->prepare("INSERT INTO carts (customer_id, product_id) VALUES (:customer_id, :product_id)");
//         $stmt->bindParam(':customer_id', $userId, PDO::PARAM_INT);
//         $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        
//         if ($stmt->execute()) {
//             return true;
//         } else {
//             return  false;// Insertion failed
//         }
//     } catch (PDOException $e) {
//         // Log error message (optional)
//         error_log("Error inserting into carts: " . $e->getMessage());
//         return false;
//     }
// }


    public function getCartItems($user_id) {
        $stmt = $this->db->prepare("SELECT products.name, products.price, carts.quantity FROM carts INNER JOIN products ON carts.product_id = products.id WHERE carts.customer_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($user_id, $product_id) {
        // Check the available stock
        $stmt = $this->db->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $stock = $stmt->fetchColumn();
    
        if ($stock === false) {
            return false; // Product not found
        }
    
        // Check the current quantity in the cart
        $stmt = $this->db->prepare("SELECT quantity FROM carts WHERE customer_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $currentQuantity = $stmt->fetchColumn() ?? 0;
    
        if ($currentQuantity + 1 > $stock) {
            return false; // Prevent adding if it exceeds stock
        }
    
        // Add or update the cart item
        $stmt = $this->db->prepare("INSERT INTO carts (customer_id, product_id, quantity) VALUES (?, ?, 1) 
            ON DUPLICATE KEY UPDATE quantity = quantity + 1");
        return $stmt->execute([$user_id, $product_id]);
    }
    
    
    public function updateCart($user_id, $product_id) {
        // Check the current quantity of the product in the cart
        $stmt = $this->db->prepare("SELECT quantity FROM carts WHERE customer_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result && $result['quantity'] > 1) {
            // Decrease quantity if it's greater than 1
            $stmt = $this->db->prepare("UPDATE carts SET quantity = quantity - 1 WHERE customer_id = ? AND product_id = ?");
            return $stmt->execute([$user_id, $product_id]);
        } else {
            // Remove item from cart if quantity is 1 or not found
            $stmt = $this->db->prepare("DELETE FROM carts WHERE customer_id = ? AND product_id = ?");
            return $stmt->execute([$user_id, $product_id]);
        }
    }

    // public function addToCart($user_id, $product_id) {
    //     $stmt = $this->db->prepare("INSERT INTO carts (customer_id, product_id, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    //     return $stmt->execute([$user_id, $product_id]);
    // }
    
    // public function removeFromCart($user_id, $product_id) {
    //     $stmt = $this->db->prepare("DELETE FROM carts WHERE customer_id = ? AND product_id = ?");
    //     $stmt->bindParam("iI", $user_id, $product_id);
    //     return $stmt->execute();
    // }

    // public function decreaseQuantity($user_id, $product_id) {
    //     $stmt = $this->db->prepare("UPDATE carts SET quantity = quantity - 1 WHERE customer_id =? AND product_id =?");
    //     $stmt->bindParam("ii", $user_id, $product_id);
    //     return $stmt->execute();
    // }

    public function getTotalPriceByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT SUM(products.price * carts.quantity) as total_price FROM carts INNER JOIN products ON carts.product_id = products.id WHERE carts.customer_id =?");
        $stmt->bindParam("i", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_price'];
    }
}

?>