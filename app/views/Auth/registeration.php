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
                    <form action="/public/register" method="post" onsubmit="validateForm(event)">
                        <div class="mb-3">
                            <label class="form-label">Full Name*</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Enter full name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email*</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password*</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password*</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Enter password" required>
                            <div id="passwordError" class="mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter address">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        <p class="text-center mt-3">Already have an account? <a href="/public/login">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm(event) {
            let password = document.getElementById("password").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let errorDiv = document.getElementById("passwordError");

            if (password !== confirmPassword) {
                errorDiv.textContent = "Passwords do not match!";
                errorDiv.style.color = "red";
                event.preventDefault(); // Stop form submission
            } else {
                errorDiv.textContent = ""; // Clear the error if passwords match
            }
        }
    </script>
</body>

</html>