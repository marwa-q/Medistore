<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <!-- Styles -->
    <style>
        /* Same styling as orders page */
        .show-btn {
            background-color: #009cff !important;
            border-color: #009cff !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .show-btn:hover {
            background-color: #0bb3d3 !important;
        }

        .edit-btn {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: black !important;
            transition: 0.3s ease-in-out;
        }

        .edit-btn:hover {
            background-color: #e0a800 !important;
        }

        .delete-btn {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .delete-btn:hover {
            background-color: #c82333 !important;
        }

        .restore-btn {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .restore-btn:hover {
            background-color: #218838 !important;
        }

        /* Adjust button size */
        .show-btn,
        .edit-btn,
        .delete-btn,
        .restore-btn {
            font-size: 14px !important;
            padding: 6px 10px !important;
        }

        /* Center table text */
        .table td,
        .table th {
            text-align: center;
            vertical-align: middle !important;
            
        }
    </style>

</head>

<body>
    <?php require_once __DIR__ . "/dash.php"; ?>
    <div class="container mt-4">
        <div class="d-flex flex-column w-100">

            <!-- Active Products Table -->
            <div class="w-100">
                <div class="text-center">
                    <h2 class="mb-4">Product List</h2>
                </div>


                <table class="table table-striped w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr id="product-<?= $product['id'] ?>">
                                <td><?= htmlspecialchars($product['id']) ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($product['price'], 2)) ?></td>
                                <td><?= htmlspecialchars(date("Y-m-d H:i", strtotime($product['created_at']))) ?></td>
                                <td><?= htmlspecialchars(date("Y-m-d H:i", strtotime($product['updated_at']))) ?></td>
                                <td>
                                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-sm edit-btn">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form method="post" action="/public/products/delete/<?= $product['id'] ?>" class="delete-product-form d-inline" data-id="<?= $product['id'] ?>" id="delete-form-<?= $product['id'] ?>">
                                        <button type="submit" class="btn btn-sm delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Deleted Products Table -->
            <div class="w-100 mt-5">
                <div class="text-center mt-2">
                    <h2 class="text-danger">Deleted Products</h2>
                </div>
                <table class="table table-bordered w-100">
                    <thead class="table-danger">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($deletedProducts as $deletedProduct): ?>
                            <tr>
                                <td><?= htmlspecialchars($deletedProduct['id']) ?></td>
                                <td><?= htmlspecialchars($deletedProduct['name']) ?></td>
                                <td>$<?= htmlspecialchars(number_format($deletedProduct['price'], 2)) ?></td>
                                <td><?= htmlspecialchars(date("Y-m-d H:i", strtotime($deletedProduct['deleted_at']))) ?></td>
                                <td>
                                    <form method="post" action="/public/products/restore/<?= $deletedProduct['id'] ?>" class="restore-product-form">
                                        <button type="submit" class="btn btn-sm restore-btn">
                                            <i class="fa-solid fa-rotate-left"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>







    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-product-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    // event.preventDefault(); // Prevent form from refreshing the page

                    let productId = this.dataset.id; // Get product ID from data attribute

                    if (confirm("Are you sure you want to delete this product?")) {
                        fetch(this.action, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log("Server Response:", data); // Debugging log
                                if (data.success) {
                                    let row = document.getElementById(`product-${productId}`);
                                    if (row) row.remove(); // Remove row from table
                                } else {
                                    alert("Error deleting product.");
                                }
                            })
                            .catch(error => console.error("Fetch Error:", error));
                    }
                });
            });
        });
    </script>
</body>

</html>