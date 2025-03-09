<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app/views/Navbar/nav.css">
    <link rel="stylesheet" href="/app/views/productsdatils.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

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
    </style>

</head>

<body>

    <!-- nav start-->


    <section class="product-details-card">
        <!-- Product Image -->
        <div class="product-image">
            <span class="category-tag"><?= htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></span>
            <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="Product Image">
        </div>

        <!-- Product Information -->
        <div class="product-info">
            <h2 class="product-name"><?= htmlspecialchars($product['name']); ?></h2>
            <h3 class="product-price"><?= htmlspecialchars($product['price']); ?> JD</h3>

            <!-- Stock Status -->
            <div class="stock-status-container">
                <button class="stock-status">
                    <i class="fa-solid fa-check-circle"></i>
                    <?= ($product['stock'] > 0) ? 'In Stock' : 'Out of Stock'; ?>
                </button>
                <span class="stock-status-text">Ships within 24 hours</span>
            </div>

            <!-- Product Description -->
            <p class="product-description">
                <?= htmlspecialchars($product['description']); ?>
            </p>

            <!-- Product Features -->
            <div class="product-features">
                <p><i class="fa-solid fa-stethoscope"></i> High-Quality Sound</p>
                <p><i class="fa-solid fa-heart-pulse"></i> Durable Material</p>
                <p><i class="fa-solid fa-shield-alt"></i> 1-Year Warranty</p>
            </div>

            <!-- Product Actions -->
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
                            <i class="fa fa-heart fa-2x"></i>
                        </button>
                    </form>
                <?php else: ?>
                    <form action="/public/addtofavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                        <button type="submit" class="btn btn-outline-danger mt-2 favorite-btn">
                            <i class="fa-regular fa-heart fa-2x"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>


    <!-- ٍstart FOOTER SECTION -->
    <footer class="section">
        <div class="container">
            <div class="row">
                <div class="col-9 col-md-9 col-sm-12">
                    <div class="content">
                        <a href="#" class="logo">
                            <h2>Medestore</h2>
                        </a>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, magni.
                        </p>
                        <div class="social-list">
                            <a href="#" class="social-item">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-sm-12">
                    <div class="row">
                        <div class="col-12 col-md-12 col-sm-12">
                            <div class="content">
                                <p><b>Medestore</b></p>
                                <ul class="footer-menu">
                                    <li><a href="aboutus.html">About us</a></li>
                                    <li><a href="pages/profile.html">My profile</a></li>
                                    <li><a href="aboutus.html">Services</a></li>
                                    <li><a href="pages/contactUs.html">Contact Us</a></li>
                                    <li><a href="pages/searchPage.html">Search</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER SECTION -->
    <!-- COPYRIGHT SECTION -->
    <div class="copyright">&copy; 2025 Medistore | All Rights Reserved</div>
    <!-- END COPYRIGHT SECTION -->

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
                                    button.innerHTML = '<i class="fa fa-heart fa-2x"></i>';
                                    this.setAttribute("action", "/public/removefromfavorites"); // ✅ Update action
                                } else {
                                    button.classList.remove("btn-danger");
                                    button.classList.add("btn-outline-danger");
                                    button.innerHTML = '<i class="fa-regular fa-heart fa-2x"></i>';
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
</body>

</html>