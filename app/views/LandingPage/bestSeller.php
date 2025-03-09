<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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

        .testimonial-section {
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(to bottom, #f0f4f8, #e6ecf3);
            /* تحسين الخلفية */
            position: relative;
        }

        .testimonial-section h2 {
            font-size: 36px;
            color: var(--darkBlue);
            margin-bottom: 40px;
        }

        /* Slider */
        .testimonial-slider {
            display: flex;
            overflow: hidden;
            position: relative;
            justify-content: center;
            gap: 20px;
            width: 100%;
            transition: transform 0.8s ease-in-out;
            /* تحسين تأثير الانزلاق */
        }

        .testimonial-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            width: 280px;
            box-shadow: 0 5px 8px rgba(0, 0, 0, 0.15);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* تأثير عند التحويم */
        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .testimonial-card img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid var(--light-blue);
            /* إطار حول الصورة */
        }

        .testimonial-card h3 {
            font-size: 22px;
            color: #003366;
            margin-bottom: 8px;
        }

        .products_star i {
            color: #ffd700;
            margin-right: 3px;
        }

        .testimonial-card p {
            font-size: 15px;
            color: #444;
            margin-top: 10px;
        }

        /* أزرار التنقل */
        .prev-btn,
        .next-btn {
            background: var(--light-blue);
            color: white;
            border: none;
            padding: 12px 16px;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .prev-btn:hover,
        .next-btn:hover {
            background-color: #003366;
        }

        /* ضبط أماكن الأزرار */
        .prev-btn {
            left: 15px;
        }

        .next-btn {
            right: 15px;
        }

        /* التصميم على الهواتف */
        @media (max-width: 768px) {
            .testimonial-card {
                width: 230px;
                padding: 20px;
            }

            .prev-btn,
            .next-btn {
                font-size: 16px;
                padding: 10px;
            }
        }

        /* Section Styles */
    </style>
</head>

<body>


    <section style="margin-bottom: 0px;" id="best">

        <section class="bestseller-section-text">
            <h2>Best Sellers</h2>
        </section>
        <!--Bestseller Products-->

        <section class="bestseller-section">

            <div class="bestseller-container">
                <?php foreach ($products as $product): ?>

                    <div class="bestseller-item">
                        <div class="bestseller-image">
                            <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="bestseller-details">
                            <h3 class="bestseller-name"><?= htmlspecialchars($product['name']); ?></h3>
                            <!-- <p>//htmlspecialchars($product['description']); </p> -->
                            <p class="bestseller-description"><?= htmlspecialchars($product['description']); ?></p>
                            <h4 class="bestseller-price"><?= htmlspecialchars($product['price']); ?> JD</h4>

                            <div class="product-actions">
                                <?php $isLoggedIn = isset($_COOKIE['id']); ?>

                                <!-- Cart Button -->
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
                    </div>
                <?php endforeach; ?>

            </div>

        </section>





        <section class="prodect-cate">
            <h2>Our Products</h2>
        </section>

        <section class="product-section">
            <div class="product-container">
                <?php foreach ($last as $product): ?>
                    <div class="product-card">
                        <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                        <h2><?= htmlspecialchars($product['name']); ?></h2>
                        <p><?= htmlspecialchars($product['description']); ?></p>
                        <h3><?= htmlspecialchars($product['price']); ?> JD</h3>

                        <div class="product-actions">
                            <!-- Add to Cart Button -->
                            <?php $isLoggedIn = isset($_COOKIE['id']); ?>

                            <!-- Cart Button -->
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



        <section class="more-details">

            <div class="div-more-details">
                <img
                    src="https://img.freepik.com/free-vector/medical-treatment-tools-composition_1284-16379.jpg?t=st=1741377329~exp=1741380929~hmac=810312a390cfd65fd94e06e8805ce1ff83e8b0f4f9c105199d57be7fa5e03d61&w=1380"
                    alt="Product Image" />
                <div class="text-more-details">
                    <div class="text-box">
                        <h3 class="h3-more-details">MEDI10</h3>
                        <p class="p-more-details">Stay stocked and save! Use MEDI10 for 10% off your first order of medical supplies.</p>

                    </div>
                </div>
            </div>

            <div class="div-more-details">
                <img
                    src="https://img.freepik.com/free-photo/medicine-uniform-healthcare-medical-workers-day-nurse-day_185193-110662.jpg"
                    alt="Product Image" />
                <div class="text-more-details">
                    <div class="text-box">
                        <h3 class="h3-more-details">HEALTHY20</h3>
                        <p class="p-more-details">Your health, your savings! Get 20% off on orders over $100 with HEALTHY20.</p>
                    </div>
                </div>
            </div>

            <div class="div-more-details">
                <img
                    src="https://img.freepik.com/premium-photo/safety-equipment-fight-coronavirus-covid-19-virus-outbreak-safety-mask-hand-sanitizer_220507-17090.jpg?w=826"
                    alt="Product Image" />
                <div class="text-more-details">
                    <div class="text-box">
                        <h3 class="h3-more-details" style="color: white;">FREESHIPMED</h3>
                        <p class="p-more-details" style="color: white;">Shop stress-free! Use FREESHIPMED for free shipping on all orders above $50.</p>
                    </div>
                </div>
            </div>
        </section>



        <!--Medical Clothing-->
        <section class="medical-section">
            <div>
                <h2 class="text-medical">Medical Clothing</h2>
            </div>
            <div>
                <?php foreach ($clothes as $item): ?>
                    <div class="medical-card">
                        <img src="<?= htmlspecialchars($item['image_url']); ?>" alt="<?= htmlspecialchars($item['name']); ?>" />
                        <h2 class="medical-name"><?= htmlspecialchars($item['name']); ?></h2>
                        <p><?= htmlspecialchars($item['description']); ?></p>
                        <h3><?= htmlspecialchars($item['price']); ?> JD</h3>

                        <div class="product-actions">
                            <?php if (in_array($item['id'], $cartProductIds)): ?>
                                <form action="/public/cart/remove" method="POST" class="cart-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']); ?>">
                                    <button type="submit" class="cart-btn">
                                        <i class="fa-solid fa-cart-shopping"></i> Remove
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="/public/cart/add" method="POST" class="cart-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']); ?>">
                                    <button type="submit" class="cart-btn">
                                        <i class="fa-solid fa-cart-shopping"></i> Add
                                    </button>
                                </form>
                            <?php endif; ?>

                            <!-- Favorite Button -->
                            <?php if (in_array($item['id'], $favoriteProductIds)): ?>
                                <form action="/public/removefromfavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']); ?>">
                                    <button type="submit" class="btn btn-danger mt-2 favorite-btn">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                </form>
                            <?php else: ?>
                                <form action="/public/addtofavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']); ?>">
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

        <!-- JavaScript for Modal -->
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
        <script src="/app/views/LandingPage/swiper.js"></script>

</body>

</html>