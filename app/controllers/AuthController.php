<?php
require_once __DIR__ . "/../models/User.php";


class AuthController 
{
    private $userModel;

    public function __construct($database)
    {
        $this->userModel = new User($database);
    }

    // public function register()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $username = $_POST["username"];
    //         $email = $_POST["email"];
    //         $password = $_POST["password"];

    //         if ($this->userModel->register($username, $email, $password)) {
    //             header("Location: /public/login");
    //             exit;
    //         } else {
    //             $error = "Registration failed!";
    //         }
    //     }
    //     require __DIR__ . "/../views/register.php"; // ✅ Fixed the path
    // }

    // public function login()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //         $usernameOrEmail = $_POST["usernameOrEmail"];
    //         $password = $_POST["password"];

    //         $user = $this->userModel->getUserByUsernameOrEmail($usernameOrEmail);
    //         if ($user && password_verify($password, $user["password"])) {
    //             $_SESSION["user"] = $user["username"];
    //             // header("Location: /dashboard");
    //             // exit;
    //             echo "<script>alert('Login successful!');</script>"; // Added JavaScript to redirect to dashboard page
    //         } else {
    //             $error = "Invalid username/email or password!";
    //         }
    //     }
    //     require __DIR__ . "/../views/login.php"; // ✅ Fixed the path
    // }
}





