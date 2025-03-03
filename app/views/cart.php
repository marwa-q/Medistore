<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
<h1>Your Cart</h1>
<ul>
    <?php foreach ($cartItems as $item): ?>
        <li>
            <strong><?= $item['name']; ?></strong>
            <p>Price: <?= $item['price']; ?>$</p>
            <p>Quantity: <?= $item['quantity'];?></p>
            <?php if (!empty($item['image_url'])): ?>
                <img src="<?= $item['image_url']; ?>" alt="<?= $item['name']; ?>" style="width: 150px; height: auto;">
            <?php endif; ?>
            <form action="<?php echo $baseUrl;?>/public/removeFromCart" method="POST">
                <input type="hidden" name="productId" value="<?php echo $item['id'];?>">
                <input type="submit" value="Remove from Cart">
            </form>
        </li>
        <br>
    <?php endforeach; ?>
</ul>