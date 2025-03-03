<?php
$host = "localhost";
$dbname = "medicx";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    global $pdo;
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
