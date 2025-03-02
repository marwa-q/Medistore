<?php
// Get base URL dynamically
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <style>
        .heart-button {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            color: red;
            background: white;
            border: 2px solid red;
            border-radius: 25px;
            padding: 8px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease-in-out;
        }

        .heart-button:hover {
            background: red;
            color: white;
            transform: scale(1.05);
        }

        .heart-button i {
            font-size: 1.2rem;
        }

        .heart-button span {
            font-size: 0.9rem;
            font-weight: bold;
        }
    </style>
</head>

<body class="container mt-4 position-relative">
    <!-- Heart Button -->
    <button class="heart-button" id="favoriteButton">
        <i class="fa fa-heart"></i>
        <span>Favorites</span>
    </button>

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
            let baseUrl = "<?= $baseUrl ?>";
            form.action = `${baseUrl}/product`;

            if (selectedCategory) {
                form.action += `/${selectedCategory}`;
            }
        });

        document.getElementById("favoriteButton").addEventListener("click", function() {
            window.location.href = "<?= $baseUrl ?>/favorite";
        });
    </script>
</body>

</html>