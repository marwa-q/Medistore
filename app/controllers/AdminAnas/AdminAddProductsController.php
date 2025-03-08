<?php

require_once __DIR__ . "/../../models/Admin.php";


class AdminAddProductsController
{

    private $adminSchema;

    public function __construct($database)
    {
        $this->adminSchema = new Admin($database);
    }

    public function showAddingPage()
    {
        require __DIR__ . "/../../views/Admin/AddNewProduct.php";
    }


    public function addProduct()
    {
        // Retrieve form data
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];

        // Validate input
        if (empty($name) || empty($price) || empty($description) || empty($quantity) || empty($category_id)) {
            die("All fields are required.");
        }

        if (!is_numeric($price) || $price <= 0) {
            die("Price must be a positive number.");
        }

        if (!is_numeric($quantity) || $quantity < 0) {
            die("Quantity must be a non-negative number.");
        }

        // Handle file upload
        if ($_FILES['image_url']['error'] === UPLOAD_ERR_OK) {
            // Define the upload directory relative to the project root
            $uploadDir = __DIR__ . '/../../../public/uploads/';

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                die("Uploads directory does not exist.");
            }

            // Ensure the uploads directory is writable
            if (!is_writable($uploadDir)) {
                die("Uploads directory is not writable.");
            }

            // Generate a unique file name to avoid conflicts
            $fileName = uniqid() . '_' . basename($_FILES['image_url']['name']);
            $uploadFile = $uploadDir . $fileName;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $uploadFile)) {
                // Save only the relative path in the database
                $image_url = '/public/uploads/' . $fileName;
            } else {
                die("Failed to move uploaded file.");
            }
        } else {
            die("File upload failed.");
        }
        // Call the model to add the product


        if ($this->adminSchema->addProduct($name, $price, $description, $quantity, $category_id, $image_url)) {
            header("Location: /public/success-page");
            exit();
        } else {
            die("Failed to add product.");
        }
    }
}
