<?php
// Get base URL dynamically
ob_start();
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .heart-button {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            color: white;
            background: wheat;
            border: 2px solid red;
            border-radius: 25px;
            padding: 8px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease-in-out;
        }

        .heart-button:hover,
        .heart-button.active {
            background: red;
            color: white;
        }

        .heart-button img {
            width: 20px;
            height: 20px;
            filter: invert(1);
            /* Makes the image white */
            transition: filter 0.3s ease-in-out;
        }

        .heart-button:hover img,
        .heart-button.active img {
            filter: invert(0);
            /* Makes the image red */
        }

        .heart-button span {
            font-size: 0.9rem;
            font-weight: bold;
        }

        /* Cart Button Styling */
        #cartButton {
            font-size: 1.2rem;
            color: #1E3A8A;
            background: white;
            border: 2px solid #1E3A8A;
            border-radius: 25px;
            padding: 8px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease-in-out;
            position: absolute;
            top: 70px;
            right: 20px;
            width: 120px;
            font-weight: bold;
        }

        #cartButton:hover {
            background: #1E3A8A;
            color: white;
        }

        #cartButton img {
            width: 20px;
            height: 20px;
            filter: invert(0);
            /* Keeps the image blue */
            transition: filter 0.3s ease-in-out;
        }

        #cartButton:hover img {
            filter: invert(1);
            /* Turns the image white */
        }

        /* User Icon with Login Text */
        .login-container {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 1.1rem;
            background: white;
            /* Background color */
            border: 2px solid #333;
            /* Border styling */
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
        }

        .login-container:hover {
            background: #007bff;
            border-color: #007bff;
            color: white;
        }

        .login-container img {
            width: 30px;
            height: 30px;
            filter: invert(0);
            /* Black color remains */
            transition: filter 0.3s ease-in-out;
        }

        .login-container:hover img {
            filter: invert(1);
            /* Turns icon white on hover */
        }
    </style>
</head>

<body class="container mt-4 position-relative">
    <a href="<?= $baseUrl ?>/login" class="login-container">
        <img src="../../assets/user-icon.svg" alt="User Icon">
        <span>Login</span>
    </a>

    <!-- Buttons -->
    <div style="display: flex; flex-direction: column;">
        <button class="heart-button" id="favoriteButton">
            <img src="../../assets/heart-svgrepo-com.svg" alt="Heart">
            <span>Favorites</span>
        </button>
        <button class="heart-button" id="cartButton">
            <img src="../../assets/shopping-cart-outline-svgrepo-com.svg" alt="Cart">
            Cart
        </button>
    </div>
    <br>

    <h1 class="mb-4 text-center">Select a Category</h1>

    <form id="categoryForm" action="<?= $baseUrl ?>/product" method="POST" class="d-flex gap-3 justify-content-center">
        <div class="mb-3">
            <label for="category" class="form-label">Choose a Category:</label>
            <select name="category_id" id="category" class="form-select">
                <option value="">All Categories</option>
                <?php
                if (!empty($cats)) {
                    foreach ($cats as $cat) {
                        echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
                    }
                } else {
                    echo "<option>No categories available</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" id="filterButton" class="btn btn-primary">Filter</button>
    </form>

    <script>
        document.getElementById("filterButton").addEventListener("click", function(event) {
            let selectedCategory = document.getElementById("category").value;
            let form = document.getElementById("categoryForm");

            // Use PHP-generated base URL
            console.log(form.action); // Check output in browser console


            if (selectedCategory) {
                form.action += `/${selectedCategory}`;
            }
        });

        document.getElementById("favoriteButton").addEventListener("click", function() {
            this.classList.toggle("active");
            window.location.href = "<?= $baseUrl ?>/favorite";
        });

        document.getElementById("cartButton").addEventListener("click", function() {
            window.location.href = "<?= $baseUrl ?>/cart";
        });
    </script>
</body>

</html>