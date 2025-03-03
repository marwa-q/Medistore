
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
</head>
<body>
    <h2>Orders List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="edit_order.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>