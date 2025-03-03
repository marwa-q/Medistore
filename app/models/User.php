<?php
require_once __DIR__ . "/../../config/database.php";
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
    public function softDeleteUser($id)
    {
        $query = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    public function removeAdmin($id)
    {
        $query = "UPDATE users SET role = 'user' WHERE id = ? AND role = 'admin'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function register($name, $email, $password)
    {
        $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $email, $password]);
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function permanentDeleteUser($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
?>