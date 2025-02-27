<?php
session_start();
require_once "../config/database.php";
require_once "../routes/Router.php";
require_once "../app/controllers/AuthController.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/ProductController.php";

$router = new Router();
$authController = new AuthController($pdo);
$userController = new UserController($pdo);

$productController = new ProductController($pdo);


// Homepage Test Route
$router->addRoute("/", function () {
    echo "Hi"; 
});

$router->addRoute("/users", function () use ($userController) {
    $userController->showUsers();
});


// // Auth Routes (Remove `/public/` from paths)
// $router->addRoute("/register", function () use ($authController) {
//     $authController->register();
// });

// $router->addRoute("/product", function () use ($productController) {
//     $productController->showProducts();
// });

// $router->addRoute("/edit", function () use ($productController) {
//     $productController->editProduct();
// });

// $router->addRoute("/login", function () use ($authController) {
//     $authController->login();
// });

// Handle request
$router->handleRequest($_SERVER["REQUEST_URI"]);
