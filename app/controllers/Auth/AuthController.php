<?php
require_once __DIR__ . "/../../models/Auth.php";
require_once __DIR__ . "/../../models/_functions.php";

class AuthController
{

    private $authModel;

    public function __construct($database)
    {
        $this->authModel = new Auth($database);
    }


    public function updateAdminSettings()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"];
            // $password = $_POST["password"];
            $name = $_POST["full_name"];
            $address = $_POST["address"];
            $adminId = $_COOKIE["id"];
            $phone_number = $_POST["phone_number"];
            if ($this->authModel->setAdminSettings($adminId, $name, $email, $phone_number, $address)) {
                header("Location: /public/dashboard");
                exit();
            } else {
                echo "<script>alert('Error updating admin settings')</script>";
            }
        }
    }

    public function checkuser()
    {
        if (!isset($_COOKIE['username'], $_COOKIE['email'], $_COOKIE['id'], $_COOKIE['role'])) {
            header("Location: /public/login");
        } else {
            if ($_COOKIE['role'] === ('admin' || 'super admin')) {
                header("Location: /public/dashboard");
            } else {
                header("Location: /public/profile");
            }
        }
    }
    public function register()
    {
        if (!isset($_COOKIE['username'], $_COOKIE['email'], $_COOKIE['id'], $_COOKIE['role'])) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $full_name = $_POST["full_name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $phone_number = $_POST["phone_number"];
                $address = $_POST["address"];

                try {
                    if ($this->authModel->register($full_name, $email, $password, $phone_number, $address)) {
                        setcookie("username", $full_name, time() + 86400, "/");
                        setcookie("email", $email, time() + 86400, "/");
                        header("Location: /public/login");
                        exit();
                    } else {
                        $error = "Registration failed. Please try again.";
                    }
                } catch (PDOException $e) {
                    // Handle duplicate email error
                    if ($e->getCode() === '23000') { // Integrity constraint violation
                        $error = "This email is already registered. Please use a different email.";
                    } else {
                        $error = "An error occurred. Please try again.";
                    }
                }
            }
            // Pass the error message to the view
            require __DIR__ . "/../../views/Auth/registeration.php";
        } else {
            header("Location: /public/profile");
        }
    }

    public function showUserSettings()
    {
        if (isset($_COOKIE['role']) && ($_COOKIE['role'] === 'admin' || $_COOKIE['role'] === 'super admin')) {
            header("Location: /public/settings");
            exit(); // Stop further execution
        }
        if (isset($_COOKIE['id'])) {
            $Id = $_COOKIE['id']; // Get the admin ID from the cookie  
            $user = $this->authModel->getUserSettings($Id);
            $userOrders = $this->authModel->getUserOrders($Id);
        } else {
            $user = null; // Handle the case where the cookie is missing  
        }
        require __DIR__ . "/../../views/Auth/profileUser.php";
    }



    /**
     * Handle the edit user settings request.
     */
    public function editUserSettings()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Decode the JSON data from the request body
            $data = json_decode(file_get_contents("php://input"), true);

            // Validate and sanitize input
            $fullName = filter_var($data['full_name'] ?? '', FILTER_SANITIZE_STRING);
            $phoneNumber = filter_var($data['phone'] ?? '', FILTER_SANITIZE_STRING);
            $address = filter_var($data['address'] ?? '', FILTER_SANITIZE_STRING);
            $email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);

            // Get the user ID from the session or cookie
            $userId = $_COOKIE['id'] ?? null;

            if (!$userId) {
                http_response_code(401); // Unauthorized
                echo json_encode(["success" => false, "message" => "User not authenticated."]);
                exit();
            }

            // Prepare the data for the model
            $userData = [
                'full_name' => $fullName,
                'phone' => $phoneNumber,
                'address' => $address,
                'email' => $email,
            ];

            // Update user settings using the model
            if ($this->authModel->updateUserSettings($_COOKIE["id"], $userData)) {
                echo json_encode(["success" => true, "message" => "Settings updated successfully."]);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["success" => false, "message" => "An error occurred while updating settings."]);
            }
        } else {
            http_response_code(405); // Method Not Allowed
            echo json_encode(["success" => false, "message" => "Invalid request method."]);
        }
    }



    public function showAdminSettings()
    {
        echo Func::checkIfLoggedIn();
        if (isset($_COOKIE['id'])) {
            $adminId = $_COOKIE['id']; // Get the admin ID from the cookie  
            $user = $this->authModel->getUserSettings($adminId);
        } else {
            $user = null; // Handle the case where the cookie is missing  
        }
        require __DIR__ . "/../../views/Admin/adminProfileSettings.php";
    }

    public function logout()
    {
        setcookie('username', '', time() - 3600, '/');
        setcookie('email', '', time() - 3600, '/');
        setcookie('id', '', time() - 3600, '/');
        setcookie('role', '', time() - 3600, '/');
        header("Location: /public/products");
        exit();
    }

    public function login()
    {
        if (!isset($_COOKIE['username'], $_COOKIE['email'], $_COOKIE['id'], $_COOKIE['role'])) {

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $user = $this->authModel->login($email, $password);

                if ($user) {
                    setcookie("username", $user["full_name"], time() + 86400, "/");
                    setcookie("email", $user["email"], time() + 86400, "/");
                    setcookie("id", $user["id"], time() + 86400, "/");
                    setcookie("role", $user["role"], time() + 86400, "/");
                    header("Location: /public/users");
                    exit();
                } else {
                    echo '
        <div id="overlay"></div>
        <div id="errorModal">
            <button class="close-btn" onclick="closeModal()">X</button>
            <h5 class="text-danger">Error</h5>
            <p>Invalid email or password.</p>
            <button class="btn btn-danger mt-2" onclick="closeModal()">Close</button>
        </div>

        <script>
            function closeModal() {
                document.getElementById("errorModal").style.display = "none";
                document.getElementById("overlay").style.display = "none";
            }

            // Show modal when error occurs
            document.getElementById("errorModal").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        </script>

        <style>
            /* Blur background when modal appears */
            #overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                display: block;
                z-index: 998;
            }

            /* Modal Styling */
            #errorModal {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                z-index: 999;
                display: block;
                width: 300px;
                text-align: center;
            }

            /* Close button */
            .close-btn {
                background: red;
                color: white;
                border: none;
                padding: 5px 10px;
                border-radius: 50%;
                font-weight: bold;
                cursor: pointer;
                position: absolute;
                top: 10px;
                right: 10px;
            }
        </style>';
                }
            }
            require __DIR__ . "/../../views/Auth/login.php";
        } else {
            header("Location: /public/profile");
        }
    }
}
