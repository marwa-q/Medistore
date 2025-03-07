<?php
require_once __DIR__ . "/_functions.php";


class Auth
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }


    public function register($full_name, $email, $password, $phone_number, $address)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO customers (full_name, email, password_hash, phone_number, address, created_at) 
          VALUES (:full_name, :email, :password, :phone_number, :address, NOW())";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":phone_number", $phone_number);
        $stmt->bindParam(":address", $address);

        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $query = "SELECT id, full_name, email, password_hash, role FROM customers WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password_hash"])) {
            return $user;
        }

        return false;
    }

    public function getAdminSettings($adminId)
    {
        echo Func::checkRegularAdmin();

        $query = "SELECT id, full_name, email, phone_number, role, address joined FROM customers WHERE id = :adminId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":adminId", $adminId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }

    public function setAdminSettings($adminId, $full_name, $email, $phone_number, $address)
    {
        $query = "UPDATE customers SET full_name = :full_name, email = :email, phone_number = :phone_number, address = :address WHERE id = :adminId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone_number", $phone_number);
        $stmt->bindParam(":adminId", $adminId);
        $stmt->bindParam(":address", $address);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getUserOrders($id)
    {
        $query = "
    SELECT 
        o.id AS order_id, 
        o.customer_id, 
        o.created_at AS order_date, 
        o.status AS order_status, 
        o.total_amount, 
        p.name AS product_name, 
        p.price AS product_price 
    FROM 
        orders o 
    JOIN 
        order_items oi ON o.id = oi.order_id 
    JOIN 
        products p ON oi.product_id = p.id 
    WHERE 
        o.customer_id = :id
";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserSettings($adminId)
    {
        $query = "SELECT id, full_name, email, address, phone_number, role, created_at joined FROM customers WHERE id = :adminId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":adminId", $adminId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }
}
