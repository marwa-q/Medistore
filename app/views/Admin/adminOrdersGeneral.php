<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensure table has an outer border */
        .table {
            border: 2px solid #dee2e6 !important;
        }



        .show-btn {
            background-color: #009cff !important;
            border-color: #009cff !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        /* Adjust button size */
        .show-btn,
        .edit-btn {
            font-size: 14px !important;
            /* Make text slightly smaller */
            padding: 6px 10px !important;
            /* Reduce padding */
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

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle !important;
            border: 1px solid #dee2e6 !important;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . "/dash.php"; ?>

    <div class="container mt-4 d-flex flex-column align-items-center">

        <h1 class="text-center mb-4">Orders List</h1> <!-- Centered Title -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Customer Email</th> <!-- New Column -->
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Orderd At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['customer_id']) ?></td>
                        <td><?= htmlspecialchars($order['customer_email']) ?></td> <!-- Customer Email Here -->
                        <td>$<?= htmlspecialchars(number_format($order['total_amount'], 2)) ?></td>
                        <td>
                            <?php
                            $status = htmlspecialchars($order['status']);
                            $statusIcons = [
                                'pending' => '<i class="fa-solid fa-hourglass-half text-warning"></i>',
                                'processing' => '<i class="fa-solid fa-spinner text-primary"></i>',
                                'shipped' => '<i class="fa-solid fa-truck text-info"></i>',
                                'delivered' => '<i class="fa-solid fa-check-circle text-success"></i>',
                                'cancelled' => '<i class="fa-solid fa-times-circle text-danger"></i>'
                            ];
                            ?>

                            <?= $statusIcons[$status] ?? '<i class="fa-solid fa-question-circle text-secondary"></i>'; ?>
                            <span class="ms-1"><?= $status; ?></span>
                        </td>
                        <td><?= htmlspecialchars(date("Y-m-d H:i", strtotime($order['created_at']))) ?></td>

                        <td>
                            <a href="orders/show/<?= $order['id'] ?>" class="btn btn-sm show-btn">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="orders/edit/<?= $order['id'] ?>" class="btn btn-sm edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </a>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>