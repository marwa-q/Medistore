<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorites</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (for heart icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .favorite-card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .favorite-card:hover {
            transform: scale(1.03);
        }

        .heart-icon {
            font-size: 24px;
            color: red;
            cursor: pointer;
        }

        .heart-icon:hover {
            color: darkred;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Your Favorites <i class="fa-solid fa-heart heart-icon"></i></h1>

        <div class="row">
            <?php foreach ($favorites as $product): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm favorite-card">
                        <?php if (!empty($product['image_url'])): ?>
                            <img src="<?= htmlspecialchars($product['image_url']); ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($product['name']); ?>"
                                style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><strong>Price:</strong> $<?= htmlspecialchars($product['price']); ?></p>
                            <p class="card-text"><strong>Stock:</strong> <?= htmlspecialchars($product['stock']); ?></p>
                            <p class="card-text"><strong>Category:</strong> <?= htmlspecialchars($product['category_id']); ?></p>
                            <button class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i> Remove from Favorites
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>