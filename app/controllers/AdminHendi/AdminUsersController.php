<?php
require_once __DIR__ . "/../../models/User.php";

class AdminUsersController
{
    private $userModel;

    public function __construct($database)
    {
        $this->userModel = new User($database);
    }

    public function showUsers()
    {
        $deletedUsers = $this->userModel->getAllDeletedUsers();
        $users = $this->userModel->getAllUsers();
        require __DIR__ . "/../../views/users.php"; // Load the users view
    }

    public function showUserById($id)
    {
        $user = $this->userModel->showUserById($id);
        require __DIR__ . "/../../views/Admin/editUsers.php"; // Load the user view
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['full_name'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phone_number'];
            $address = $_POST['address'];
            $role = $_POST['role'];
            echo $role;

            if ($this->userModel->updateCustomer($id, $name, $email, $phoneNumber, $address, $role)) {
                header("Location: /public/users");
                exit;
            } else {
                header("Location: /public/users/edit?id=$id&error=failed");
                exit;
            }
        }
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];

            if ($this->userModel->softDeleteCustomer($id)) {
                header("Location: /public/users");
                exit;
            } else {
                echo "Error deleting user.";
            }
        }
    }
}

