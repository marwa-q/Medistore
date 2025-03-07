<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="/app/views/Checkout/checkout.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <main>
        <section id="cart-section">
            <h3><strong>Your Order</strong></h3>
            <table id="cart-table">
                <thead>
                    <tr id="table-head">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="cart-body">
                    <?php
                    $subtotal = 0; // Initialize subtotal
                    foreach ($cartItems as $item):
                        $total = $item['price'] * $item['quantity']; // Calculate total for each item
                        $subtotal += $total; // Add to subtotal
                    ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($item['image_url'] ?? '../images/sample-product.jpg') ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td>$<?= number_format($total, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <hr>
        <section id="order-total">
            <h3><strong>Billing Details</strong></h3>
            <div class="invoice-container">
                <table>
                    <tr>
                        <td>Subtotal:</td>
                        <td>$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Total after discount:</td>
                        <td>$<?= number_format($subtotal, 2) ?></td> <!-- Adjust if discounts are applied -->
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>$5.00</td> <!-- Fixed shipping cost -->
                    </tr>
                    <tr class="total-row">
                        <td><strong>Total:</strong></td>
                        <td><strong>$<?= number_format($subtotal + 5, 2) ?></strong></td> <!-- Subtotal + Shipping -->
                    </tr>
                </table>
                <form action="/public/checkout" method="POST">

                    <label for="fullName">Full Name *</label>
                    <input type="text" id="fullName" name="fullName" required>
                    <span class="error" id="fullNameError"></span>
                    <br>
                    <label for="phone">Phone Number *</label>
                    <input type="text" id="phone" name="phone" required>
                    <span class="error" id="phoneError"></span>
                    <br>
                    <label for="address">Address *</label>
                    <input type="text" id="address" name="address" required>
                    <span class="error" id="addressError"></span>

                    <div style="display: flex; align-items: center;">
                        <input style="width: 50px;" type="radio" id="cash_payment" name="payment_method" value="cash" required>
                        <label for="cash_payment">💵 Cash on Delivery</label>
                    </div>
                    <button type="submit" id="placeOrderBtn">Place Order</button>
                </form>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../js/checkOut.js"></script> -->
</body>

</html>