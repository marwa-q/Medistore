<?php
$currentPage = basename($_SERVER['REQUEST_URI']);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/_AdminDashboard/dashboard.css">
    <style>
        .menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Adjust this value to decrease spacing */
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<div class="sidebar">
    <div class="logo"></div>
    <ul class="menu">
        <li class="<?= ($currentPage == 'dashboard') ? 'active' : ''; ?>">
            <a href="/public/dashboard">
                <i class="fa-solid fa-gauge-high fa-lg"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'super admin'): ?>
            <li class="<?= ($currentPage == 'users') ? 'active' : ''; ?>">
                <a href="/public/users">
                    <i class="fa-solid fa-users fa-lg"></i>
                    <span>Users</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="<?= ($currentPage == 'products') ? 'active' : ''; ?>">
            <a href="/public/products">
                <i class="fa-solid fa-shopping-cart fa-lg"></i>
                <span>Products</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'addNewProduct') ? 'active' : ''; ?>">
            <a href="/public/addNewProduct">
                <i class="fa-solid fa-cart-plus fa-lg"></i>
                <span>Add Product</span>
            </a>
        </li>
        <li class="<?= ($currentPage == 'orders') ? 'active' : ''; ?>">
            <a href="/public/orders">
                <i class="fa-solid fa-box fa-lg"></i>
                <span>Orders</span>
            </a>
        </li>

        <li class="<?= ($currentPage == 'settings') ? 'active' : ''; ?>">
            <a href="/public/settings">
                <i class="fas fa-cog fa-lg"></i>
                <span>Settings</span>
            </a>
        </li>

    </ul>
</div>