<?php
require_once __DIR__ . "/_functions.php";

class User
{
    private $db;

    public function __construct($database)
    {

        $this->db = $database;
    }

    public function getAllUsers()
    {
        echo Func::checkSuperAdmin();
        $stmt = $this->db->prepare("SELECT id, full_name, email, role FROM customers WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDeletedUsers()
    {
        echo Func::checkSuperAdmin();
        $stmt = $this->db->prepare("SELECT id, full_name, email, role FROM customers WHERE deleted_at IS NOT NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showUserById($id)
    {
        echo Func::checkSuperAdmin();
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCustomer($id, $name, $email, $phoneNumber, $address, $role)
    {
        echo Func::checkSuperAdmin();
        $sql = "UPDATE customers SET email = ?, phone_number = ?, address = ?, role = ?,full_name = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$email, $phoneNumber, $address, $role, $name, $id]);
    }

    public function softDeleteCustomer($id)
    {
        echo Func::checkSuperAdmin();
        $sql = "UPDATE customers SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
