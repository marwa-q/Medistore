
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Order</h2>
    <form method="POST" action="../controllers/OrderController.php?action=updateOrder">
        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        <label>Status:</label>
        <select name="status">
            <option value="pending" <?php if ($order['status'] == 'pending') echo "selected"; ?>>Pending</option>
            <option value="processing" <?php if ($order['status'] == 'processing') echo "selected"; ?>>Processing</option>
            <option value="completed" <?php if ($order['status'] == 'completed') echo "selected"; ?>>Completed</option>
            <option value="canceled" <?php if ($order['status'] == 'canceled') echo "selected"; ?>>Canceled</option>
        </select>
        <button type="submit">Update</button>
    </form>
    <h2>Order Details</h2>
    <p>
        <?php
        if (isset($order)) {
            foreach ($order as $key => $value) {
                echo "$key: $value";
                echo "<br>";  // Adding a line break for readability in the output.
            }
        } else {
            echo "No order details available.";
        }
        ?>
    </p>
</body>
</html>
