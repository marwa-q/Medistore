<?php
require_once __DIR__ . "/../models/User.php";

class UserController
{
    private $userModel;

    public function __construct($database)
    {
        $this->userModel = new User($database);
    }

    public function showUsers()
    {
        $users = $this->userModel->getAllUsers();
        require __DIR__ . "/../views/users.php"; // Load the users view
    }
}
