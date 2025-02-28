<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Order Details (Order #<?= htmlspecialchars($order["id"]) ?>)</h1>
        <p><strong>Customer ID:</strong> <?= htmlspecialchars($order["customer_id"]) ?></p>
        <p><strong>Total Amount:</strong> $<?= htmlspecialchars(number_format($order["total_amount"], 2)) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($order["status"]) ?></p>
        <p><strong>Created At:</strong> <?= htmlspecialchars($order["created_at"]) ?></p>

        <h2 class="mt-4">Order Items</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item["id"]) ?></td>
                        <td><?= htmlspecialchars($item["product_name"]) ?></td> <!-- Product Name Here -->
                        <td><?= htmlspecialchars($item["quantity"]) ?></td>
                        <td>$<?= htmlspecialchars(number_format($item["price"], 2)) ?></td>
                        <td>$<?= htmlspecialchars(number_format($item["quantity"] * $item["price"], 2)) ?></td>
                        <td><?= htmlspecialchars($item["created_at"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="http://localhost/PHP_Tasks/Task31(MVC)/public/orders" class="btn btn-primary">Back to Orders</a>

    </div>
    <div class="container mt-4">
        <h2 class="mb-3">Order Edit History</h2>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Action</th>
                            <th>Details</th>
                            <th>Edited At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?= htmlspecialchars($log['action']) ?></td>
                                <td><?= htmlspecialchars($log['details']) ?></td>
                                <td><?= htmlspecialchars($log['edited_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>

</html>