<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        li{
            list-style: none;
        }
    </style>
</head>
<body>
    <h1>All products</h1>
    <ul>
    <?php 
        foreach ($products as $product){
            echo "<li>Name:- {$product['name']}</li>";
            echo "<li>price:- {$product['price']}$</li>";
            echo "<li>in stock:- {$product['stock']}</li>";
            echo "<li>category:- {$product['category_id']}</li>";
            echo "<br>";
        }
    ?>
    </ul>
</body>
</html>