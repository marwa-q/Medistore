<?php
// Get base URL dynamically
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        li {
            list-style: none;
        }
    </style>
</head>

<body class="container mt-4">

    <h1 class="text-center mb-4">All Products</h1>

    <ul class="list-group">
        <?php foreach ($products as $product): ?>
            <li class="list-group-item d-flex flex-column align-items-center text-center">
                <a href="<?= $baseUrl ?>/product_details/<?= htmlspecialchars($product['id']); ?>" class="text-decoration-none">
                    <strong class="fs-5"><?= htmlspecialchars($product['name']); ?></strong>
                </a>
                <p class="mb-1"><strong>Price:</strong> <?= htmlspecialchars($product['price']); ?>$</p>
                <p class="mb-1"><strong>Stock:</strong> <?= htmlspecialchars($product['stock']); ?></p>
                <p class="mb-1"><strong>Category:</strong> <?= htmlspecialchars($product['category_name']); ?></p>

                <?php if (!empty($product['image_url'])): ?>
                    <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="img-thumbnail" style="width: 150px; height: auto;">
                <?php endif; ?>

                <!-- Add to cart button -->
                <?php if (in_array($product['id'], $cartProductIds)) : ?>
                    <form action="/public/cart/remove" method="POST" class="cart-form">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                        <button type="submit" class="btn btn-danger mt-2">
                            🛒 Remove from Cart
                        </button>
                    </form>
                <?php else : ?>
                    <form action="/public/cart/add" method="POST" class="cart-form">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                        <button type="submit" class="btn btn-outline-primary mt-2">
                            ➕ Add to Cart
                        </button>
                    </form>
                <?php endif; ?>



                <!-- Check if product is in favorites -->
                <?php if (in_array($product['id'], $favoriteProductIds)): ?>
                    <button type="button" class="btn btn-danger mt-2 favorite-btn" data-product-id="<?= htmlspecialchars($product['id']); ?>" data-action="remove">
                        <i class="fa fa-heart"></i> Favorited
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-outline-danger mt-2 favorite-btn" data-product-id="<?= htmlspecialchars($product['id']); ?>" data-action="add">
                        <i class="fa fa-heart"></i> Add to Favorites
                    </button>
                <?php endif; ?>

            </li>
        <?php endforeach; ?>
    </ul>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.favorite-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const action = this.getAttribute('data-action');
                    const url = action === 'add' ? '<?= $baseUrl ?>/addtofavorites' : '<?= $baseUrl ?>/removefromfavorites';

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `product_id=${productId}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Toggle button state
                                if (action === 'add') {
                                    button.classList.remove('btn-outline-danger');
                                    button.classList.add('btn-danger');
                                    button.setAttribute('data-action', 'remove');
                                    button.innerHTML = '<i class="fa fa-heart"></i> Favorited';
                                } else {
                                    button.classList.remove('btn-danger');
                                    button.classList.add('btn-outline-danger');
                                    button.setAttribute('data-action', 'add');
                                    button.innerHTML = '<i class="fa fa-heart"></i> Add to Favorites';
                                }
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    <!-- Bootstrap JS (Optional, for better interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>