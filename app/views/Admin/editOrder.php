<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order #<?= htmlspecialchars($order['id']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Order #<?= htmlspecialchars($order['id']) ?></h2>
        </div>
        <div class="card-body">
            <form action="/public/orders/update/<?= $order['id'] ?>" method="POST">
                <!-- Status Dropdown -->
                <div class="mb-4">
                    <label for="status" class="form-label">Order Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>
                            <i class="fa-solid fa-hourglass-half text-warning"></i> Pending
                        </option>
                        <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>
                            <i class="fa-solid fa-spinner text-primary"></i> Processing
                        </option>
                        <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>
                            <i class="fa-solid fa-truck text-info"></i> Shipped
                        </option>
                        <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>
                            <i class="fa-solid fa-check-circle text-success"></i> Delivered
                        </option>
                        <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>
                            <i class="fa-solid fa-times-circle text-danger"></i> Cancelled
                        </option>
                    </select>
                </div>

                <!-- Order Items Table -->
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
                                        data-product-id="<?= $item['product_id'] ?>"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-3">
                    <a href="/public/orders" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let orderId, productId;

            // Set up the delete button click handler
            document.querySelectorAll(".delete-item").forEach(button => {
                button.addEventListener("click", function() {
                    orderId = this.getAttribute("data-order-id");
                    productId = this.getAttribute("data-product-id");
                });
            });

            // Handle the confirmation delete button
            document.getElementById("confirmDelete").addEventListener("click", function() {
                fetch(`/public/orders/deleteItem/${orderId}/${productId}`, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the row from the table
                            document.querySelector(`button[data-order-id="${orderId}"][data-product-id="${productId}"]`)
                                .closest("tr").remove();
                        } else {
                            alert("Failed to delete item: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error))
                    .finally(() => {
                        // Close the modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                        modal.hide();
                    });
            });
        });
    </script>
</body>

</html>