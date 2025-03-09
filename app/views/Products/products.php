<?php
// Get base URL dynamically
ob_start();
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/app/views/Navbar/nav.css">
    <style>
        .favorite-btn {
            background: none;
            /* border: 2px solid #e50000; */
            color: #e50000;
            font-size: 1rem;
            padding: 8px 12px;
            /* border-radius: 25px; */
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        /* .favorite-btn.active {
            background: #e50000;
            color: white;
        } */

        .favorite-btn i {
            margin-right: 0px;
        }

        /* .favorite-btn:hover {
            background: #e50000;
            color: white;
        } */

        /* Blur background when modal is open */
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 1000;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            z-index: 1001;
        }

        .modal-content {
            padding: 10px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }

        .login-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #ff4747;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .product-card {
            cursor: pointer;
            /* Change cursor to pointer on hover */
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            /* Optional: Add hover effects */
        }

        .product-card:hover {
            transform: scale(1.02);
            /* Optional: Slightly scale up on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Optional: Add shadow on hover */
        }

        .cate {
            text-align: center;
            margin: 50px auto;
            padding: 30px 20px;
            background-color: var(--soft-grey);
            border-radius: 12px;
            max-width: 100%;
        }

        .cate h2 {
            font-size: 26px;
            color: var(--darkBlue);
            margin-bottom: 20px;
        }

        /* جعل جميع الأزرار في سطر واحد */
        .cate ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            /* السماح بانكسار العناصر على الأسطر عند الحاجة */
            padding-bottom: 10px;
        }

        /* ضبط كل فورم بحجم مناسب */
        .cate form {
            flex: 1;
            max-width: 200px;
            /* حجم مناسب للأزرار */
        }

        /* ستايل الأزرار بدون خلفية مع بوردر */
        .cate button {
            background: transparent;
            /* خلفية شفافة */
            color: var(--light-blue);
            font-size: 16px;
            padding: 12px;
            border: 2px solid var(--light-blue);
            /* بوردر فقط */
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            white-space: nowrap;
            /* منع النص من الانكسار */
        }

        /* تغيير اللون عند التحويم */
        .cate button:hover {
            background: var(--light-blue);
            color: var(--white);
        }

        /* عند الضغط، يبقى الزر مفعّل */
        .cate button.active {
            background: var(--light-blue) !important;
            color: var(--white) !important;
            border-color: var(--light-blue) !important;
        }

        /* 📱 Responsive Design */

        /* للأجهزة المتوسطة (تابلت) */
        @media (max-width: 992px) {
            .cate ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            .cate form {
                max-width: 180px;
            }
        }

        /* للأجهزة الصغيرة (الموبايلات) */
        @media (max-width: 768px) {
            .cate ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            .cate form {
                max-width: 160px;
            }
        }

        /* للأجهزة الصغيرة جداً */
        @media (max-width: 480px) {
            .cate ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            .cate form {
                max-width: 140px;
            }
        }
    </style>

</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner">
        <div class="spinner-grow text-primary" role="status"></div>
    </div> -->
    <!-- Spinner End -->


    <section class="cate">
        <h2>Our Products</h2>
        <ul>
            <form action="/public/product" method="POST">
                <button type="submit">
                    <li>All Products</li>
                </button>
            </form>

            <form action="/public/product/1" method="POST">
                <button type="submit">
                    <li>Medical Clothing</li>
                </button>
            </form>

            <form action="/public/product/2" method="POST">
                <button type="submit">
                    <li>Medical Supplies</li>
                </button>
            </form>

            <form action="/public/product/3" method="POST">
                <button type="submit">
                    <li>Medical Equipment</li>
                </button>
            </form>

            <form action="/public/product/4" method="POST">
                <button type="submit">
                    <li>Medical Accessories</li>
                </button>
            </form>

        </ul>
    </section>


    <section class="product-section">
        <div class="product-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= $product['image_url']; ?>" alt="<?= htmlspecialchars($product['name']); ?>" onclick="r(<?= $product['id'] ?>)">
                    <h2><?= htmlspecialchars($product['name']); ?></h2>
                    <p><?= htmlspecialchars($product['description']); ?></p>
                    <h3><?= htmlspecialchars($product['price']); ?> JD</h3>

                    <div class="product-actions">
                        <?php $isLoggedIn = isset($_COOKIE['id']); ?>

                        <!-- Add to Cart Button -->
                        <?php if (in_array($product['id'], $cartProductIds)): ?>
                            <form action="/public/cart/remove" method="POST" class="cart-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                                <button type="submit" class="cart-btn">
                                    <i class="fa-solid fa-cart-shopping"></i> Remove
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="/public/cart/add" method="POST" class="cart-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                                <button type="submit" class="cart-btn">
                                    <i class="fa-solid fa-cart-shopping"></i> Add
                                </button>
                            </form>
                        <?php endif; ?>

                        <!-- Favorite Button -->
                        <?php if (in_array($product['id'], $favoriteProductIds)): ?>
                            <form action="/public/removefromfavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                                <button type="submit" class="btn btn-danger mt-2 favorite-btn">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="/public/addtofavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                                <button type="submit" class="btn btn-outline-danger mt-2 favorite-btn">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Please Log In</h2>
            <p>You need to log in to add items to your cart or favorites.</p>
            <a href="/public/login" class="login-button">Go to Login</a>
        </div>
    </div>

    <!-- Overlay Background -->
    <div id="overlay"></div>
    <script>
        function r(productId) {
            window.location.href = '/public/productr/' + productId;
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cart-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // ✅ Stop default form submission

                    const formData = new FormData(this);
                    const url = this.getAttribute('action'); // ✅ AJAX URL
                    const button = this.querySelector('button');

                    fetch(url, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // ✅ Toggle button appearance
                                if (url.includes('add')) {
                                    button.classList.remove('btn-outline-primary');
                                    button.classList.add('btn-danger');

                                    button.innerHTML = '<i class="fa-solid fa-cart-shopping"></i> Remove';
                                    this.setAttribute('action', '/public/cart/remove'); // ✅ Update action
                                } else {
                                    button.classList.remove('btn-danger');
                                    button.classList.add('btn-outline-primary');
                                    button.innerHTML = '<i class="fa-solid fa-cart-shopping"></i> Add';
                                    this.setAttribute('action', '/public/cart/add'); // ✅ Update action
                                }

                                // ✅ Update cart count dynamically
                                updateCartCount(data.cart_count);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });

        // Function to update the cart count
        function updateCartCount(count) {
            const cartButton = document.getElementById("cartButton");
            if (cartButton) {
                cartButton.querySelector("span").innerText = `${count}`;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".favorite-form").forEach((form) => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault(); // ✅ Stop full-page reload

                    const formData = new FormData(this);
                    const url = this.getAttribute("action"); // ✅ AJAX URL
                    const button = this.querySelector("button");

                    fetch(url, {
                            method: "POST",
                            body: formData,
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.status === "success") {
                                // ✅ Toggle button appearance
                                if (url.includes("add")) {
                                    button.classList.remove("btn-outline-danger");
                                    button.classList.add("btn-danger");
                                    button.innerHTML = '<i class="fa fa-heart"></i>';
                                    this.setAttribute("action", "/public/removefromfavorites"); // ✅ Update action
                                } else {
                                    button.classList.remove("btn-danger");
                                    button.classList.add("btn-outline-danger");
                                    button.innerHTML = '<i class="fa-regular fa-heart"></i>';
                                    this.setAttribute("action", "/public/addtofavorites"); // ✅ Update action
                                }

                                // ✅ Update favorite count dynamically
                                updateFavoriteCount(data.favorite_count);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch((error) => console.error("Error:", error));
                });
            });
        });

        // Function to update the favorite count in the header
        function updateFavoriteCount(count) {
            const favButton = document.getElementById("favoriteButton");
            if (favButton) {
                favButton.querySelector("span").innerText = `${count}`;
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginRequiredForms = document.querySelectorAll(".login-required");
            const modal = document.getElementById("loginModal");
            const overlay = document.getElementById("overlay");
            const closeButton = document.querySelector(".close-btn");

            loginRequiredForms.forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent form submission
                    modal.style.display = "block";
                    overlay.style.display = "block";
                });
            });

            closeButton.addEventListener("click", function() {
                modal.style.display = "none";
                overlay.style.display = "none";
            });

            overlay.addEventListener("click", function() {
                modal.style.display = "none";
                overlay.style.display = "none";
            });
        });
    </script>
    <script src="/app/views/LandingPage/swiper.js"></script>

</body>

</html>