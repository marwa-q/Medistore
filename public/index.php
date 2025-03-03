<?php
session_start();
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../routes/Router.php";
require_once __DIR__ . "/../app/controllers/AuthController.php";
require_once __DIR__ . "/../app/controllers/UserController.php";
require_once __DIR__ . "/../app/controllers/ProductController.php";
require_once __DIR__ . "/../app/controllers/OrderController.php";

$router = new Router();
$authController = new AuthController($pdo);
$userController = new UserController($pdo);
$productController = new ProductController($pdo);
$orderController = new OrderController($pdo);
$router->addRoute("/", function () {
    echo "Hi"; 
});

$router->addRoute("/users", function () use ($userController) {
    if (isset($_GET['action']) && isset($_GET['id'])) {
        if ($_GET['action'] === 'softDelete') {
            $userController->softDelete($_GET['id']);
        } elseif ($_GET['action'] === 'makeUser') {
            $userController->makeUser($_GET['id']);
        } elseif ($_GET['action'] === 'permanentDelete') {
            $userController->permanentDelete($_GET['id']);
        }
    } else {
        $userController->showUsers();
    }
});

$router->addRoute("/register", function () use ($authController) {
    $authController->register();
});

$router->addRoute("/login", function () use ($authController) {
    $authController->login();
});

$router->addRoute("/product", function () use ($productController) {
    $productController->showProducts();
});

$router->addRoute("/edit/:id", function ($id) use ($productController) {
    $productController->editProduct($id);
});

$router->addRoute("/updateOrder", function () use ($orderController) {
    $orderController->updateOrder();
});
$router->addRoute("/updateProduct", function () use ($productController) {
    $productController->updateProduct();
});
$router->handleRequest($_SERVER["REQUEST_URI"]);
?>
