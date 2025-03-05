<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-4">
    <h2 class="mb-4">Product List</h2>

    <table class="table table-striped">
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
                    <td><?= htmlspecialchars($product['created_at']) ?></td>
                    <td><?= htmlspecialchars($product['updated_at']) ?></td>
                    <td>
                        <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="/public/products/delete/<?= $product['id'] ?>" class="delete-product-form" data-id="<?= $product['id'] ?>" id="delete-form-<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>


                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <!-- Deleted Products Table -->
    <h2 class="mt-5 text-danger">Deleted Products</h2>
    <table class="table table-bordered">
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
                    <td><?= htmlspecialchars($deletedProduct['deleted_at']) ?></td>
                    <td>
                        <form method="post" action="/public/products/restore/<?= $deletedProduct['id'] ?>" class="restore-product-form">
                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

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