<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order #<?= htmlspecialchars($order['id']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Order #<?= htmlspecialchars($order['id']) ?></h2>
        </div>
        <div class="card-body">
            <form action="http://localhost/PHP_Tasks/Task31(MVC)/public/orders/update/<?= $order['id'] ?>" method="POST">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                <td>
                                    <input type="number" name="quantities[<?= $item['product_id'] ?>]"
                                        value="<?= $item['quantity'] ?>"
                                        class="form-control" min="1">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete-item"
                                        data-order-id="<?= $order['id'] ?>"
                                        data-product-id="<?= $item['product_id'] ?>">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <a href="http://localhost/PHP_Tasks/Task31(MVC)/public/orders" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-item").forEach(button => {
            button.addEventListener("click", function() {
                let orderId = this.getAttribute("data-order-id");
                let productId = this.getAttribute("data-product-id");

                if (!confirm("Are you sure you want to delete this item?")) {
                    return;
                }

                fetch(`http://localhost/PHP_Tasks/Task31(MVC)/public/orders/deleteItem/${orderId}/${productId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json()) // Expect JSON from PHP
                    .then(data => {
                        if (data.success) {
                            this.closest("tr").remove(); // Remove row from table
                        } else {
                            alert("Failed to delete item: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    });
</script>

</html>