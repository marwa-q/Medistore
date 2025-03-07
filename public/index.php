<?php
session_start();
require_once "../config/database.php";
require_once "../routes/Router.php";
require_once "../app/controllers/Auth/AuthController.php";

require_once "../app/controllers/AdminAnas/AdminOrdersController.php";
require_once "../app/controllers/AdminAnas/AdminProductsController.php";
require_once "../app/controllers/AdminHendi/AdminUsersController.php";

require_once "../app/controllers/ProductHeba/CategoryController.php";
require_once "../app/controllers/ProductHeba/FavoriteController.php";
require_once "../app/controllers/ProductHeba/ProductController.php";

require_once "../app/controllers/NavController/ProductsController.php";

require_once "../app/controllers/CartMarwa/CartController.php";

require_once "../app/controllers/NavController/NavController.php";
require_once "../app/controllers/NavController/LandingController.php";

require_once "../app/controllers/CheckoutOrder/OrderController.php";


$router = new Router();
$authController = new AuthController($pdo);
$AdminUsersController = new AdminUsersController($pdo);
$adminProductsController = new AdminProductsController($pdo);
$AdminOrdersController = new AdminOrdersController($pdo);

$NavController = new NavController($pdo);
$landingController = new LandingController($pdo);
//Heba
$productController = new ProductController($pdo);
$FavoriteController = new FavoriteController($pdo);
$categoryController = new CategoryController($pdo);

//Marwa 
$cartController = new CartController($pdo);

$orderController = new OrderController($pdo);

$theProductController = new ProductsController($pdo);

// Test
// $productController->showAllCategories();
$router->addRoute("/dashboard", function () {
    require_once __DIR__ . '/../app/views/_AdminDashboard/dashboard.php';
});
/****************************************************************/
// Homepage Test Route

$router->addRoute("/", function () use ($NavController, $landingController) {
    $landingController->showLandingPage();
    $NavController->showNavBar();
    $landingController->showProductsBestSellers();
    require_once __DIR__ . '/../app/views/LandingPage/additionalLanding.php';
    require_once __DIR__ . '/../app/views/Navbar/footer.php';
});

$router->addRoute("/checkuser", function () use ($authController) {
    $authController->checkUser();
});

$router->addRoute("/product/:id", function ($id) use ($theProductController, $NavController) {
    $NavController->showNavBar();
    $theProductController->showProductByCategory($id);
    require_once __DIR__ . '/../app/views/Navbar/footer.php';
});

$router->addRoute("/product", function () use ($theProductController, $NavController) {
    $NavController->showNavBar();
    $theProductController->showProductByCategory(null);
    require_once __DIR__ . '/../app/views/Navbar/footer.php';
});

$router->addRoute("/profile", function () use ($authController, $NavController) {
    if ($_COOKIE['role'] === "user") {
        $NavController->showNavBar();
    }
    $authController->showUserSettings();
});

$router->addRoute("/contactus",function () use ($NavController){
    $NavController->showNavBar();
    require_once __DIR__. '/../app/views/landingPage/contactus.php';
});

$router->addRoute("/settings", function () use ($authController) {
    $authController->showAdminSettings();
});

$router->addRoute("/aboutus", function () use ($NavController) {
    $NavController->showNavBar();
    require_once __DIR__ . '/../app/views/LandingPage/aboutme.php';
    require_once __DIR__ . '/../app/views/Navbar/footer.php';
});


$router->addRoute("/updateAdmin", function () use ($authController) {
    $authController->updateAdminSettings();
});



// Hendi 

$router->addRoute("/admin/settings", function () use ($authController) {
    $authController->showAdminSettings();
});
$router->addRoute("/users", function () use ($AdminUsersController) {
    $AdminUsersController->showUsers();
});

$router->addRoute("/users/update", function () use ($AdminUsersController) {
    $AdminUsersController->updateUser();
});

$router->addRoute("/users/edit/:id", function ($id) use ($AdminUsersController) {
    $AdminUsersController->showUserById($id);
});

$router->addRoute("/users/delete", function () use ($AdminUsersController) {
    $AdminUsersController->deleteUser();
});

// Anas
$router->addRoute("/register", function () use ($authController) {
    $authController->register();
});

$router->addRoute("/login", function () use ($authController) {
    $authController->login();
});

$router->addRoute("/logout", function () use ($authController) {
    $authController->logout();
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

$router->addRoute("/products/edit/:id", function ($id) use ($adminProductsController) {
    $adminProductsController->updateProduct($id);
});

$router->addRoute("/products/update/:id", function ($id) use ($adminProductsController) {
    $adminProductsController->saveChangesUpdate($id);
});
//Heba
// $router->addRoute("/product", function () use ($productController, $NavController) {
//     $NavController->showNavBar();
//     // $productController->showAllCategories();
//     // $productController->showProducts();

// });

// $router->addRoute("/product/:id", function ($id) use ($productController) {
//     $productController->productsDepentOnCat($id);
// });

$router->addRoute("/product_details/:id", function ($id) use ($productController) {
    $productController->productDetails($id);
});

$router->addRoute("/favorite", function () use ($FavoriteController) {
    $FavoriteController->showFavorites();
});

$router->addRoute("/addtofavorites", function () use ($FavoriteController) {
    $FavoriteController->addToFavorites();
});

$router->addRoute("/removefromfavorites", function () use ($FavoriteController) {
    $FavoriteController->removeFromFavorites();
});


//Marwa 

$router->addRoute('/cart', function () use ($cartController) {
    $cartController->showCart();
});

$router->addRoute('/cart/add', function () use ($cartController) {
    $cartController->addToCart();
});

$router->addRoute('/cart/update', function () use ($cartController) {
    $cartController->updateCart();
});

$router->addRoute('/cart/remove', function () use ($cartController) {
    $cartController->removeFromCart();
});

$router->addRoute('/cart/clear', function () use ($cartController) {
    $cartController->clearCart();
});

// Checkout Page
$router->addRoute('/checkout', function () use ($orderController) {
    $orderController->checkout();
});



$router->addRoute('/thank-you', function () {
    require_once __DIR__ . '/../app/views/Checkout/thank_you.php';
});




// Handle request
$router->handleRequest($_SERVER["REQUEST_URI"]);
