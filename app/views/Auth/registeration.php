<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center">Register</h3>

                    <!-- Display Error Message -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form action="/public/register" method="post" onsubmit="validateForm(event)">
                        <!-- Full Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name*</label>
                            <input type="text" name="full_name" id="fullName" class="form-control" placeholder="Enter full name" value="<?= htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                            <div id="fullNameError" class="mt-1 text-danger"></div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                            <div id="emailError" class="mt-1 text-danger"></div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">Password*</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                            <div id="passwordError" class="mt-1 text-danger"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">Confirm Password*</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Enter password" required>
                            <div id="confirmPasswordError" class="mt-1 text-danger"></div>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="phoneNumber" class="form-control" placeholder="Enter phone number" value="<?= htmlspecialchars($_POST['phone_number'] ?? ''); ?>">
                            <div id="phoneNumberError" class="mt-1 text-danger"></div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" value="<?= htmlspecialchars($_POST['address'] ?? ''); ?>">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        <p class="text-center mt-3">Already have an account? <a href="/public/login">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm(event) {
            // Clear previous errors
            clearErrors();

            // Get form values
            let fullName = document.getElementById("fullName").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let phoneNumber = document.getElementById("phoneNumber").value.trim();

            // Validation flags
            let isValid = true;

            // Full Name Validation
            if (fullName === "") {
                document.getElementById("fullNameError").textContent = "Full name is required.";
                isValid = false;
            }

            // Email Validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById("emailError").textContent = "Please enter a valid email address.";
                isValid = false;
            }

            // Password Validation
            if (password.length < 7) {
                document.getElementById("passwordError").textContent =
                    "Password must be at least 7 characters long.";
                isValid = false;
            }

            // Confirm Password Validation
            if (password !== confirmPassword) {
                document.getElementById("confirmPasswordError").textContent = "Passwords do not match.";
                isValid = false;
            }

            // Phone Number Validation (Optional)
            const phoneRegex = /^\d{10}$/; // Assumes a 10-digit phone number
            if (phoneNumber && !phoneRegex.test(phoneNumber)) {
                document.getElementById("phoneNumberError").textContent = "Please enter a valid 10-digit phone number.";
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        }

        // Clear all error messages
        function clearErrors() {
            let errorDivs = document.querySelectorAll(".text-danger");
            errorDivs.forEach(div => div.textContent = "");
        }
    </script>
</body>

</html>