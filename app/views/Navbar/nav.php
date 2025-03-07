<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medistore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- تضمين مكتبة Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/app/views/Navbar/nav.css">
    <!-- تضمين مكتبة Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .nav-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: inherit;
            text-decoration: none;
            padding: 8px 12px;
            transition: 0.3s ease-in-out;
            font-weight: bold;
            position: relative;
        }

        .nav-button:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .nav-button i {
            font-size: 18px;
            position: relative;
        }

        .cart-count {
            background-color: red;
            color: white;
            font-size: 12px;
            font-weight: bold;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -10px;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> -->
    <!-- Spinner End -->

    <!-- nav start-->
    <header>
        <nav class="navbar">
            <a href="index.html" class="navbar-logo">MediStore</a>




            <div class="menu-toggle" onclick="toggleMenu()">
                <i class="fa fa-bars"></i>
            </div>

            <ul class="nav-links">
                <li><a href="/public/" style="color: #009cff;">Home</a></li>
                <li><a href="/public/product">Products</a></li>
                <li><a href="/public/aboutus">About Us</a></li>
                <li><a href="..\html\products.html">Contact Us</a></li>
            </ul>

            <div class="icon-nav">

                <form action="/public/favorite" method="POST" style="display:inline;">
                    <button type="submit" class="nav-button" id="favoriteButton">
                        <i class="fa-solid fa-heart">
                            <span class="cart-count"><?= count($favoriteProductIds) ?></span>
                        </i>
                    </button>
                </form>

                <form action="/public/cart" method="POST" style="display:inline;">
                    <button type="submit" class="nav-button" id="cartButton">
                        <i class="fa-solid fa-cart-shopping">
                            <span class="cart-count"><?= count($CartProductId) ?></span>

                        </i>
                    </button>
                </form>
                <form style="display: inline;" method="POST" action="/public/checkuser">
                    <button type="submit" class="nav-button">
                        <i class="fa-solid fa-user">

                        </i>
                    </button>

                </form>
            </div>


        </nav>
    </header>
    <script>
        document.getElementById("favoriteButton").addEventListener("click", function(event) {
            this.closest("form").submit();
        });

        document.getElementById("cartButton").addEventListener("click", function(event) {
            this.closest("form").submit();
        });
    </script>
</body>

</html>