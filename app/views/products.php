<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
    <style>
        li {
            list-style: none;
        }
    </style>
</head>

<body>
    <h1>All Products</h1>
    <ul>
    <?php
    // Ensure that $products is passed correctly
    if (isset($products) && !empty($products)) {
        foreach ($products as $product) {
            echo "<li><strong>Name:</strong> {$product['name']}</li>";
            echo "<li><strong>Price:</strong> {$product['price']}$</li>";
            echo "<li><strong>In Stock:</strong> {$product['stock']}</li>";
            echo "<li><strong>Category:</strong> {$product['category_id']}</li>";
            echo "<li><a href='/edit/" . $product['id'] . "'>Edit</a></li>";
            echo "<hr>";
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
    </ul>
</body>
</html>