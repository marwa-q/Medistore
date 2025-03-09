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

    <main class="container-fluid">
        <section id="cart-section" class="container">
            <h3><strong>Your Order</strong></h3>

            <!-- Table Wrapper to Limit Width -->
            <div class="table-responsive d-flex justify-content-center">
                <table id="cart-table" class="mt-4 table table-bordered text-center m-0" style="max-width: 75%; width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <?php
                        $subtotal = 0;
                        foreach ($cartItems as $item):
                            $total = $item['price'] * $item['quantity'];
                            $subtotal += $total;
                        ?>
                            <tr>
                                <td>
                                    <img src="<?= htmlspecialchars($item['image_url'] ?? '../images/sample-product.jpg') ?>"
                                        alt="<?= htmlspecialchars($item['name']) ?>"
                                        class="img-fluid cart-image">
                                </td>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td><?= htmlspecialchars($item['quantity']) ?></td>
                                <td>$<?= number_format($total, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <section id="coupon-section">
                <div class="coupon-container d-flex flex-column flex-md-row gap-2">
                    <input name="coupon" type="text" id="couponCode" placeholder="Enter coupon code" class="form-control">
                    <button onclick="applyCoupon()" class="btn btn-primary">Apply</button>
                </div>
                <p id="couponMessage" class="text-danger"></p>
            </section>
        </section>

        <hr>

        <section id="order-total" class="container">
            <h3><strong>Billing Details</strong></h3>

            <!-- Centered Invoice -->
            <div class="invoice-container mx-auto" style="max-width: 600px;">
                <table class="table table-striped m-0">
                    <tr>
                        <td>Subtotal:</td>
                        <td id="subtotal">$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Discount:</td>
                        <td id="discount">$0.00</td> <!-- Placeholder for discount -->
                    </tr>
                    <tr>
                        <td>Total after discount:</td>
                        <td id="total-after-discount">$<?= number_format($subtotal, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>$5.00</td> <!-- Fixed shipping cost -->
                    </tr>
                    <tr class="total-row">
                        <td><strong>Total:</strong></td>
                        <td><strong id="grand-total">$<?= number_format($subtotal + 5, 2) ?></strong></td>
                    </tr>
                </table>

                <!-- Checkout Form -->
                <form action="/public/checkout" method="POST" class="mt-3">
                    <label for="fullName">Full Name *</label>
                    <input type="hidden" id="customerId" value="<?= htmlspecialchars($_COOKIE['id'] ?? '') ?>">
                    <input type="text" id="fullName" name="fullName" class="form-control" required>
                    <span class="error text-danger" id="fullNameError"></span>

                    <label for="phone" class="mt-2">Phone Number *</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                    <span class="error text-danger" id="phoneError"></span>

                    <label for="address" class="mt-2">Address *</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                    <span class="error text-danger" id="addressError"></span>

                    <div class="d-flex align-items-center mt-3">
                        <input style="width: 20px;" type="radio" id="cash_payment" name="payment_method" value="cash" required>
                        <label for="cash_payment" class="ms-2">💵 Cash on Delivery</label>
                    </div>

                    <input type="hidden" id="coupon" name="coupon" value="">

                    <button type="submit" id="placeOrderBtn" class="btn btn-success w-100 mt-3">Place Order</button>
                </form>
            </div>
        </section>
    </main>

    <script>
        async function applyCoupon() {
            const couponCode = document.getElementById('couponCode').value;
            const customerId = <?= $_COOKIE['id'] ?>; // Retrieve customerId from the hidden input

            if (!couponCode) {
                document.getElementById('couponMessage').textContent = 'Please enter a coupon code.';
                return;
            }

            if (!customerId) {
                document.getElementById('couponMessage').textContent = 'Customer ID not found. Please log in again.';
                return;
            }

            try {
                // Send a POST request to the /copon route
                const response = await fetch('/public/copon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode,
                        customer_id: customerId
                    }),
                });

                // Parse the JSON response
                const result = await response.json();

                if (result.success) {
                    // Update the UI with the discount
                    updateTotalPrice(result.discount_value);
                    document.getElementById('couponMessage').textContent = result.message;
                    // Set the hidden coupon field
                    document.getElementById('coupon').value = couponCode;
                } else {
                    document.getElementById('couponMessage').textContent = result.message;
                }
            } catch (error) {
                console.error('Error applying coupon:', error);
                document.getElementById('couponMessage').textContent = 'An error occurred. Please try again.';
            }
        }

        function updateTotalPrice(discountValue) {
            try {
                // Get the subtotal from the DOM
                const subtotalElement = document.getElementById('subtotal');
                if (!subtotalElement) {
                    throw new Error('Subtotal element not found.');
                }
                const subtotal = parseFloat(subtotalElement.textContent.replace('$', '').replace(',', ''));
                if (isNaN(subtotal)) {
                    throw new Error('Invalid subtotal value.');
                }

                const shipping = 5.00; // Fixed shipping cost

                // Calculate discount amount
                const discountAmount = (subtotal * discountValue) / 100; // Apply discount percentage
                if (isNaN(discountAmount)) {
                    throw new Error('Invalid discount value.');
                }

                const totalAfterDiscount = subtotal - discountAmount;
                if (isNaN(totalAfterDiscount)) {
                    throw new Error('Invalid total after discount calculation.');
                }

                // Update the discount, total after discount, and grand total
                const discountElement = document.getElementById('discount');
                const totalAfterDiscountElement = document.getElementById('total-after-discount');
                const grandTotalElement = document.getElementById('grand-total');

                if (!discountElement || !totalAfterDiscountElement || !grandTotalElement) {
                    throw new Error('One or more elements not found in the DOM.');
                }

                discountElement.textContent = `-$${discountAmount.toFixed(2)}`;
                totalAfterDiscountElement.textContent = `$${totalAfterDiscount.toFixed(2)}`;
                grandTotalElement.textContent = `$${(totalAfterDiscount + shipping).toFixed(2)}`;
            } catch (error) {
                console.error('Error updating total price:', error.message);
                // Optionally, display an error message to the user
                document.getElementById('couponMessage').textContent = 'An error occurred while updating the total price. Please try again.';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../js/checkOut.js"></script> -->
</body>

</html>