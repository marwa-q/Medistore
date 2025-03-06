<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background: #F5F5F5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }

        .header {
            font-size: 22px;
            font-weight: 800;
            color: #1E3A8A;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #F5F5F5;
        }

        .readonly {
            background: #EAEAEA;
            pointer-events: none;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background: #1E3A8A;
            color: white;
        }

        .btn-secondary {
            background: #009CFF;
            color: white;
        }

        .btn-danger {
            background: #DC3545;
            color: white;
        }
    </style>
</head>

<body>
    <?php require_once __DIR__ . "/dash.php"; ?>
    <div class="container mt-4">
        <div class="d-flex flex-column w-100">
            <div class="header">Admin Settings</div>

            <form action="update_admin.php" method="POST">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" name="id" value="<?= htmlspecialchars($user['id']) ?>" class="readonly" readonly>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select class="readonly" disabled>
                        <option selected><?= htmlspecialchars($user['role']) ?></option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" placeholder="Enter phone number">
                </div>

                <div class="form-group">
                    <label>Joined Date</label>
                    <input type="text" name="joined" value="January 15, 2025" class="readonly" readonly>
                </div>

                <div class="buttons">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary">Reset Password</button>
                    <button type="button" class="btn btn-danger">Delete Account</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>