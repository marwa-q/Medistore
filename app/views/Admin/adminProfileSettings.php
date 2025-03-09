<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        .container {
            background: #FFFFFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
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

        .bton {
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

        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

      
    </style>
</head>

<body>
    <?php require_once __DIR__ . "/dash.php"; ?>
    <div class="container" style="display: flex; justify-content: space-around;">
        <div class="d-flex flex-column w-100 s">
            <div class="header">Admin Settings</div>

            <form action="/public/updateAdmin" method="POST">
                <!-- User ID as text -->
                <div class="form-group">
                    <label>User ID</label>
                    <p><?= htmlspecialchars($user['id']) ?></p>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>" class="readonly" readonly>
                </div>

                <!-- Role as text -->
                <div class="form-group">
                    <label>Role</label>
                    <p><?= htmlspecialchars($_COOKIE['role']) ?></p>
                </div>

                <!-- Full Name (editable) -->
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                </div>

                <!-- Email Address (editable) -->
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <!-- Phone Number (editable) -->
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" placeholder="<?= htmlspecialchars($user['phone_number']) ?>">
                </div>

                <!-- Address (editable) -->
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="<?= htmlspecialchars($user['address']) ?>">
                </div>

                <!-- Joined Date as text -->
                <div class="form-group">
                    <label>Joined Date</label>
                    <p>January 15, 2025</p>
                </div>

                <!-- Buttons -->
                <div class="buttons">
                    <button type="submit" class="bton btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Logout Button -->
    <button type="button" class="btn btn-danger logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="/public/logout" method="POST">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>