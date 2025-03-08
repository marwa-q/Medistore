<?php
require_once __DIR__ . "/_functions.php";


class Product
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }



    public function getAllProducts()
    {
        // Func::checkRegularAdmin();
        $stmt = $this->db->prepare("
        SELECT p.*, c.name AS category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.deleted_at IS NULL
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // ✅ Return the result
    }

    public function getBestSellers() {
        $sql = "
            SELECT 
                p.*, 
                SUM(oi.quantity) AS total_quantity 
            FROM 
                order_items oi 
            JOIN 
                products p ON oi.product_id = p.id 
            GROUP BY 
                oi.product_id 
            ORDER BY 
                total_quantity DESC 
            LIMIT 3
        ";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get deleted products
    public function getDeletedProducts()
    {
        Func::checkRegularAdmin();
        $stmt = $this->db->prepare("SELECT * FROM products WHERE deleted_at IS NOT NULL");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Soft delete product by setting deleted_at timestamp
    public function deleteProduct($id)
    {
        Func::checkRegularAdmin();
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Restore deleted product
    public function restoreProduct($id)
    {
        Func::checkRegularAdmin();
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NULL WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->prepare("
        SELECT p.*, c.name AS category_name 
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = :id
    ");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProductByIdOnly($id)
{
    // Prepare the SQL query to select only product details
    $stmt = $this->db->prepare("
        SELECT *
        FROM products
        WHERE id = :id
    ");

    // Bind the ID parameter
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the product as an associative array
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function softDeleteProduct($id)
    {
        Func::checkRegularAdmin();
        $stmt = $this->db->prepare("UPDATE products SET deleted_at = NOW() WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }


    public function getProductsByCat($id)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, c.name AS category_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE p.category_id = :category_id AND p.deleted_at IS NULL
        ");
        $stmt->execute(['category_id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCart($customer_id)
    {

        $stmt = $this->db->prepare("SELECT carts.*, products.name, products.price FROM carts 
                                    JOIN products ON carts.product_id = products.id 
                                    WHERE customer_id = ?");
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll();
    }

    public function getCartProductIds($customer_id)
    {
        $stmt = $this->db->prepare("SELECT product_id FROM carts WHERE customer_id = ?");
        $stmt->execute([$customer_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getCartItemCount($user_id)
    {
        $stmt = $this->db->prepare("SELECT product_id, quantity FROM carts WHERE customer_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch as an associative array
    }



    public function getProductsByCategory($categoryId)
    {
        $query = "SELECT * FROM  categories";
        if ($categoryId) {
            $query .= " WHERE category_id = :category_id";
        }
        $stmt = $this->db->prepare($query);
        if ($categoryId) {
            $stmt->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addProductToFavorites($userId, $productId)
    {
        $stmt = $this->db->prepare("INSERT INTO favorites (customer_id, product_id) VALUES (:customer_id, :product_id)");
        $stmt->bindParam(":customer_id", $userId, PDO::PARAM_INT);
        $stmt->bindParam(":product_id", $productId, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getFavoritesByUser($userId)
    {
        $stmt = $this->db->prepare("SELECT product_id FROM favorites WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Returns an array of product IDs
    }

    public function getUserCartItems($userId)
    {
        $stmt = $this->db->prepare("SELECT product_id FROM carts WHERE customer_id = :customer_id");
        $stmt->bindParam(':customer_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Returns an array of product IDs
    }

    public function updateProduct($id, $data)
    {
        try {
            // Prepare the SQL query to update the product
            $stmt = $this->db->prepare("
                UPDATE products 
                SET 
                    name = :name, 
                    description = :description, 
                    price = :price, 
                    stock = :stock, 
                    image_url = :image_url 
                WHERE id = :id
            ");

            // Bind parameters
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':stock', $data['stock']);
            $stmt->bindParam(':image_url', $data['image_url']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Return true if the update was successful
            return true;
        } catch (PDOException $e) {
            // Log the error (you can replace this with your logging mechanism)
            error_log("Error updating product: " . $e->getMessage());

            // Return false if an error occurred
            return false;
        }
    }
}
