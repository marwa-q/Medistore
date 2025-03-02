<?php
session_start();
require_once "../config/database.php";
require_once "../routes/Router.php";
require_once "../app/controllers/Auth/AuthController.php";
require_once "../app/controllers/UserController.php";

require_once "../app/controllers/AdminAnas/AdminOrdersController.php";
require_once "../app/controllers/AdminAnas/AdminProductsController.php";

$router = new Router();
$authController = new AuthController($pdo);
$userController = new UserController($pdo);

$adminProductsController = new AdminProductsController($pdo);

$AdminOrdersController = new AdminOrdersController($pdo);


// Homepage Test Route
$router->addRoute("/", function () {
    echo "Hi";
});

$router->addRoute("/users", function () use ($userController) {
    $userController->showUsers();
});

$router->addRoute("/register", function () use ($authController) {
    $authController->register();
});

$router->addRoute("/login", function () use ($authController) {
    $authController->login();
});

$router->addRoute("/orders", function () use ($AdminOrdersController) {
    $AdminOrdersController->getAllGeneralOrders();
});

$router->addRoute("/orders/show/:id", function ($id) use ($AdminOrdersController) {
    $AdminOrdersController->getSpecificOrder($id);
});

$router->addRoute("/orders/edit/:id", function ($id) use ($AdminOrdersController) {
    $AdminOrdersController->editOrder($id);
});

$router->addRoute('/orders/update/:id', function ($id) use ($AdminOrdersController) {
    $AdminOrdersController->updateOrder($id);
});

$router->addRoute("/orders/deleteItem/:orderId/:productId", function ($orderId, $productId) use ($AdminOrdersController) {
    $AdminOrdersController->deleteOrderItem($orderId, $productId);
});

$router->addRoute("/products", function () use ($adminProductsController) {
    $adminProductsController->getProducts();
});


$router->addRoute("/products/delete/:id", function ($id) use ($adminProductsController) {
    $adminProductsController->deleteProduct($id);
});

$router->addRoute('/products/restore/:id', function ($id) use ($adminProductsController) {
    $adminProductsController->restore($id);
});

// Handle request
$router->handleRequest($_SERVER["REQUEST_URI"]);
