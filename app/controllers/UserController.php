<?php
require_once __DIR__ . "/../../config/database.php"; // تأكد من أن المسار يصحح لمكان ملف التكوين
require_once __DIR__ . "/../models/User.php";

class UserController {
    private $pdo;

    public function __construct($database) {
        $this->pdo = new User($database);
    }
    public function softDelete($id) {
        if ($_SESSION['role'] === 'superadmin' || $_SESSION['role'] === 'admin') {
            $result = $this->pdo->softDeleteUser($id);
            if ($result) {
                header("Location: ../views/users.php?message=User soft deleted successfully");
            } else {
                header("Location: ../views/users.php?error=Failed to soft delete user");
            }
        } else {
            header("Location: ../views/users.php?error=Unauthorized action");
        }
        exit();
    }
    
    public function permanentDelete($id) {
        if ($_SESSION['role'] === 'superadmin') {
            $result = $this->pdo->permanentDeleteUser($id);
            if ($result) {
                header("Location: ../views/users.php?message=User permanently deleted successfully");
            } else {
                header("Location: ../views/users.php?error=Failed to permanently delete user");
            }
        } else {
            header("Location: ../views/users.php?error=Unauthorized action");
        }
        exit();
    }
    
    public function makeUser($id) {
        if ($_SESSION['role'] === 'superadmin') {
            $result = $this->pdo->removeAdmin($id);
            if ($result) {
                header("Location: ../views/users.php?message=Admin privileges removed successfully");
            } else {
                header("Location: ../views/users.php?error=Failed to remove admin privileges");
            }
        } else {
            header("Location: ../views/users.php?error=Unauthorized action");
        }
        exit();
    }

    public function showUsers() {
        $users = $this->pdo->getAllUsers();
        require_once __DIR__ . "/../views/users.php";
    }
}
?>
