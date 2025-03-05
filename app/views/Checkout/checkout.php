
<div class="container">
    <h2>Checkout</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/public/checkout" method="POST">
        <div class="mb-3">
            <label for="address" class="form-label">Address (City, Street, etc.)</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <div>
                <input type="radio" name="payment_method" value="cash" required> Cash
                <input type="radio" name="payment_method" value="debit_card" required> Debit Card
            </div>
        </div>

        <button type="submit" class="btn btn-success">Place Order</button>
    </form>
</div>
