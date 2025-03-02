<?php

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
        $query = "SELECT id, full_name, email, password_hash FROM customers WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password_hash"])) {
            return $user;
        }

        return false;
    }
}
