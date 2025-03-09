<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-content {
            padding: 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }

        .form-group label {
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .form-control-file {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            background: #f8f9fa;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-primary:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . "/dash.php"; ?>

    <div class="main-content">
        <div class="form-container">
            <h2>Add New Product</h2>
            <form action="/public/add/newProduct" method="POST" enctype="multipart/form-data">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="name" required>
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
                </div>

                <!-- Price Field -->
                <div class="form-group">
                    <label for="productPrice">Price</label>
                    <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
                </div>

                <!-- Stock Field -->
                <div class="form-group">
                    <label for="productStock">Quantity (Stock)</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>

                <!-- Category Dropdown -->
                <div class="form-group">
                    <label for="productCategory">Category</label>
                    <select class="form-control" id="productCategory" name="category_id" required>
                        <option value="1">Medical Clothing</option>
                        <option value="2">Medical Supplies</option>
                        <option value="3">Medical Equipment</option>
                        <option value="4">Medical Accessories</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <input type="file" class="form-control-file" id="productImage" name="image_url" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>