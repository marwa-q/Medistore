<?php
// Get base URL dynamically
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>

<body>
    <div class="product-details">
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
        <p>Stock: <?php echo htmlspecialchars($product['stock']); ?></p>
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
        <br>
        <a href="<?= $baseUrl ?>/public/product">Back to Products List</a>

        <?php if (in_array($product['id'], $favoriteProductIds)): ?>
            <form action="<?= $baseUrl ?>/public/removefromfavorites" method="POST" class="favorite-form">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                <button type="submit" class="btn btn-danger mt-2">
                    <i class="fa fa-heart"></i> Favorited
                </button>
            </form>
        <?php else: ?>
            <form action="<?= $baseUrl ?>/public/addtofavorites" method="POST" class="favorite-form">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                <button type="submit" class="btn btn-outline-danger mt-2">
                    <i class="fa fa-heart"></i> Add to Favorites
                </button>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>