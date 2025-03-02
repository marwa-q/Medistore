<?php
session_start();
require_once "../config/database.php";
require_once "../routes/Router.php";
require_once "../app/controllers/AuthController.php";
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/ProductController.php";
require_once "../app/controllers/CategoryController.php";
require_once "../app/controllers/FavoritesController.php";

$router = new Router();
$authController = new AuthController($pdo);
$userController = new UserController($pdo);

$productController = new ProductController($pdo);
$CategoryController = new CategoryController($pdo);
$FavoritesController = new FavoriteController($pdo);
// Homepage Test Route
$router->addRoute("/", function () {
    echo "Hi";
});
// عرض الفئات

// عرض المنتجات بناءً على الفئة
// if (isset($_GET['category_id'])) {

$productController->showAllCategories();


// } else {
//    $products = $productController->showCategory();
// }




$router->addRoute("/users", function () use ($userController) {
    $userController->showUsers();
});

$router->addRoute("/product", function () use ($productController) {
    $productController->showProducts();
});

$router->addRoute("/product/:id", function ($id) use ($productController) {
    $productController->productsDepentOnCat($id);
});

$router->addRoute("/product_details/:id", function ($id) use ($productController) {
    $productController->productDetails($id);
});

// $router->addRoute("/Category", function () use ($productController) {
//     $productController->showCategory();
// });

// $router->addRoute("/cat/:id", function ($id) use ($productController) {
//     $productController->showCategory($id);
// });

$router->addRoute("/favorite", function () use ($FavoritesController) {
    $FavoritesController->showFavorites("1");
});

$router->addRoute("/addtofavorites",function () use ($FavoritesController) {
    $FavoritesController->addToFavorites();
});

$router->addRoute("/removefromfavorites", function () use ($FavoritesController) {
    $FavoritesController->removeFromFavorites();
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
