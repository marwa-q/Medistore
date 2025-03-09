<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .show-btn {
            background-color: #009cff !important;
            border-color: #009cff !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .show-btn:hover {
            background-color: #0bb3d3 !important;
        }

        .edit-btn {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: black !important;
            transition: 0.3s ease-in-out;
        }

        .edit-btn:hover {
            background-color: #e0a800 !important;
        }

        .delete-btn {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .delete-btn:hover {
            background-color: #c82333 !important;
        }

        .restore-btn {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: white !important;
            transition: 0.3s ease-in-out;
        }

        .restore-btn:hover {
            background-color: #218838 !important;
        }

        .show-btn,
        .edit-btn,
        .delete-btn,
        .restore-btn {
            font-size: 14px !important;
            padding: 6px 10px !important;
        }

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle !important;
            border: 1px solid #dee2e6 !important;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . "/Admin/dash.php"; ?>
    <div class="container mt-4">
        <div class="d-flex flex-column w-100">
            <h2 class="text-center mb-4">Registered Users</h2>

            <table class="table table-striped w-100">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']); ?></td>
                            <td><?= htmlspecialchars($user['full_name']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td><?= htmlspecialchars($user['role']); ?></td>
                            <td>
                                <a href="/public/users/edit/<?= $user['id']; ?>" class="btn btn-sm edit-btn">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="/public/users/delete" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                                    <button type="submit" class="btn btn-sm delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2 class="text-center mb-4 text-danger">Deleted Users</h2>

            <table class="table table-bordered w-100">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($deletedUsers as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']); ?></td>
                            <td><?= htmlspecialchars($user['full_name']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td><?= htmlspecialchars($user['role']); ?></td>
                            <td>
                                <form action="/public/users/restore" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to restore this user?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                                    <button type="submit" class="btn btn-sm restore-btn">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>