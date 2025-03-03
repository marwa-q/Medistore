<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



<h1>Your Favorites</h1>
<ul>
    <?php foreach ($favorites as $product): ?>
        <li>
            <strong><?= $product['name']; ?></strong>
            <p>Price: <?= $product['price']; ?>$</p>
            <p>Stock: <?= $product['stock']; ?></p>
            <p>Category: <?= $product['category_id']; ?></p>
            <?php if (!empty($product['image_url'])): ?>
                <img src="<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>" style="width: 150px; height: auto;">
            <?php endif; ?>
        </li>
        <br>
    <?php endforeach; ?>
</ul>



















