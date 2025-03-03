<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/User.php";

class AuthController {
    private $pdo;

    public function __construct($database) {
        $this->pdo = new User($database);
    }
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $this->pdo->getUserByEmail($email);
            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["role"] = $user["role"];
                header("Location: /");
                exit();
            } else {
                $error = "Invalid email or password!";
            }
        }
        require __DIR__ . "/../views/login.php";
    }
    
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            if ($this->pdo->register($name, $email, $password)) {
                header("Location: /login");
                exit();
            } else {
                $error = "Registration failed!";
            }
        }
        require __DIR__ . "/../views/register.php";
    }
}
?>
