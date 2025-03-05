<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <h2 class="text-center mb-4">Edit User Details</h2>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4><?= htmlspecialchars($user['full_name']); ?></h4>
        </div>
        <div class="card-body">
            <form action="/public/users/update" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                <div class="mb-3">
                    <h3 class="text-primary">User ID: #<?= htmlspecialchars($user['id']); ?></h3>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label"><strong>Full Name:</strong></label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                        value="<?= htmlspecialchars($user['full_name']); ?>" required>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email:</strong></label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label"><strong>Phone Number:</strong></label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="<?= htmlspecialchars($user['phone_number']); ?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label"><strong>Address:</strong></label>
                    <textarea class="form-control" id="address" name="address" rows="2"><?= htmlspecialchars($user['address']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label"><strong>Role:</strong></label>
                    <select class="form-select" id="role" name="role">
                        <option value="user" <?= ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="text-center">
                    <a href="/public/users" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>