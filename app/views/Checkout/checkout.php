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
                    <tr>
                        <td><img src="../images/sample-product.jpg" alt="Product 1" width="50"></td>
                        <td>Sample Product 1</td>
                        <td>$20.00</td>
                        <td>2</td>
                        <td>$40.00</td>
                    </tr>
                    <tr>
                        <td><img src="../images/sample-product2.jpg" alt="Product 2" width="50"></td>
                        <td>Sample Product 2</td>
                        <td>$15.00</td>
                        <td>1</td>
                        <td>$15.00</td>
                    </tr>
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
                        <td>$55.00</td>
                    </tr>
                    <tr>
                        <td>Total after discount:</td>
                        <td>$55.00</td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>$5.00</td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>Total:</strong></td>
                        <td><strong>$60.00</strong></td>
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