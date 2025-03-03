<?php
require_once __DIR__ . "/../../config/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found.");
    }
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $query = "UPDATE products SET name = ?, price = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $price, $id]);

    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>"><br>
        <label>Price:</label>
        <input type="text" name="price" value="<?= htmlspecialchars($product['price']); ?>"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>