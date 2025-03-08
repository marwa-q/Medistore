<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .modal-footer .btn {
            flex: 0 0 auto;
            /* Prevent buttons from growing or shrinking */
        }

        .nav-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: inherit;
            text-decoration: none;
            padding: 8px 12px;
            transition: 0.3s ease-in-out;
            font-weight: bold;
            position: relative;
        }

        .nav-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .nav-button i {
            font-size: 18px;
            position: relative;
        }

        .cart-count {
            background-color: red;
            color: white;
            font-size: 12px;
            font-weight: bold;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container" style="margin-top: 72px;">
        <ul class="nav nav-tabs" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab">Order History</button>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="profile" role="tabpanel">
                <div class="card p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4>Profile Details</h4>
                        <form action="/public/logout" method="POST">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                    <p class="text-muted">Member since <?= htmlspecialchars(date('F Y', strtotime($user['joined']))); ?></p>

                    <form action="/update-profile" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" placeholder="<?= htmlspecialchars($user['full_name'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="<?= htmlspecialchars($user['phone_number'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Street Address</label>
                            <input type="text" name="address" class="form-control" placeholder="<?= htmlspecialchars($user['address'] ?? ''); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="<?= htmlspecialchars($user['email'] ?? ''); ?>">
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="save">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </form>

                    <div class="mt-3">
                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="reset">
                            <i class="fas fa-key"></i> Reset Password
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="delete">
                            <i class="fas fa-trash"></i> Delete Account
                        </button>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="card p-4 shadow-sm">
                    <h4>Order History</h4>
                    <?php if (!empty($userOrders)) : ?>
                        <div class="accordion" id="ordersAccordion">
                            <?php
                            // Group orders by order_id
                            $groupedOrders = [];
                            foreach ($userOrders as $order) {
                                $groupedOrders[$order['order_id']][] = $order;
                            }
                            ?>

                            <?php foreach ($groupedOrders as $orderId => $items) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $orderId; ?>">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $orderId; ?>" aria-expanded="false" aria-controls="collapse<?= $orderId; ?>">
                                            Order ID: <?= htmlspecialchars($orderId); ?> - Status: <?= htmlspecialchars(ucfirst($items[0]['order_status'])); ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $orderId; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $orderId; ?>" data-bs-parent="#ordersAccordion">
                                        <div class="accordion-body">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Order Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($items as $item) : ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($item['product_name']); ?></td>
                                                            <td>$<?= htmlspecialchars(number_format($item['product_price'], 2)); ?></td>
                                                            <td><?= htmlspecialchars(date('F j, Y', strtotime($item['order_date']))); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="text-muted">No orders available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to proceed with this action?
                </div>
                <div class="modal-footer d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary px-4" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let actionType = '';

            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    actionType = this.getAttribute('data-action');
                });
            });

            document.getElementById('confirmAction').addEventListener('click', function() {
                if (actionType === 'logout') {
                    document.querySelector('form[action="/public/logout"]').submit();
                } else if (actionType === 'save') {
                    document.querySelector('form[action="/update-profile"]').submit();
                } else if (actionType === 'reset') {
                    alert('Reset password functionality not implemented.');
                } else if (actionType === 'delete') {
                    alert('Delete account functionality not implemented.');
                }
            });
        });
    </script>
    <script src="/app/views/LandingPage/swiper.js"></script>

</body>

</html>