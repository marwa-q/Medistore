<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th,
        .cart-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .cart-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .cart-buttons button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-minus,
        .btn-plus {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        .btn-trash {
            background-color: red;
            color: white;
            border-radius: 5px;
        }

        .btn-minus:hover,
        .btn-plus:hover {
            background-color: #0056b3;
        }

        .btn-trash:hover {
            background-color: darkred;
        }

        /* Centered Container for Checkout */
        .cart-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .coupon-section {
            margin-bottom: 15px;
            text-align: center;
        }

        .checkout-btn {
            background-color: green;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        .checkout-btn:hover {
            background-color: darkgreen;
        }

        .clear-btn {
            background-color: gray;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }

        .clear-btn:hover {
            background-color: darkgray;
        }
    </style>
</head>

<body>
    <h1>Your Cart</h1>

    <?php if (!empty($cartItems)) : ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item) : ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        <td>
                            <div class="cart-buttons">
                                <form method="POST" action="/public/cart/update">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="quantity" value="<?= $item['quantity'] - 1 ?>">
                                    <button type="submit" class="btn-minus">−</button>
                                </form>

                                <form method="POST" action="/public/cart/update">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <input type="hidden" name="quantity" value="<?= $item['quantity'] + 1 ?>">
                                    <button type="submit" class="btn-plus">+</button>
                                </form>

                                <form method="POST" action="/public/cart/remove">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" class="btn-trash">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Checkout Section -->
        <div class="cart-actions">
            <!-- Coupon Section -->
            <div class="coupon-section">
                <label for="coupon">Have a coupon?</label>
                <input type="text" id="coupon" name="coupon_code" placeholder="Enter code">
                <button type="button">Apply</button>
            </div>

            <form method="POST" action="/public/checkout">
                <button type="submit" class="checkout-btn">Proceed to Checkout</button>
            </form>

            <form method="POST" action="/public/cart/clear">
                <button type="submit" class="clear-btn">Clear Cart</button>
            </form>
        </div>

    <?php else : ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>

</html>