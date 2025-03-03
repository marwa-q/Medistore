
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
</head>
<body>
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']); ?></td>
                <td><?= htmlspecialchars($user['full_name']); ?></td>
                <td><?= htmlspecialchars($user['email']); ?></td>
                <td><?= htmlspecialchars($user['role']); ?></td>
                <td>
                    <!-- زر Soft Delete -->
                    <a href="../controllers/UserController.php?action=softDelete&id=<?= $user['id']; ?>" 
                       onclick="return confirm('Are you sure you want to soft delete this user?');">
                       Soft Delete
                    </a>
                    |
                    <!-- زر Remove Admin (لتحويل Admin إلى User) -->
                    <a href="../controllers/UserController.php?action=makeUser&id=<?= $user['id']; ?>" 
                       onclick="return confirm('Are you sure you want to remove admin privileges?');">
                       Remove Admin
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>