<?php
class User
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }


    // public function register($username, $email, $password)
    // {
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    //     $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    //     $stmt = $this->db->prepare($query);
    //     return $stmt->execute([$username, $email, $hashedPassword]);
    // }

    

    // public function getUserByUsernameOrEmail($usernameOrEmail)
    // {
    //     $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT id, full_name, email FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
