<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorites</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (for heart icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/app/views/Navbar/nav.css">
    <style>
        .favorite-card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .favorite-card:hover {
            transform: scale(1.03);
        }

        .heart-icon {
            font-size: 24px;
            color: red;
            cursor: pointer;
        }

        .heart-icon:hover {
            color: darkred;
        }

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

        .bestseller-item {
            border-radius: 10px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            overflow: hidden;
            margin-bottom: 20px;
            /* Add spacing between cards */
        }

        .bestseller-item:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .bestseller-image img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .favorite-btn i {
            font-size: 18px;
        }

        .custom-border {
            border: 2px solid var(--darkBlue);
            /* Use the custom color variable */
        }

        /* Section Styles */
    </style>
</head>

<body class="mt-4">

    <h1 style="font-size: 60px" class="text-center mb-4">Your Favorites</i></h1>

    <section class="product-section">
        <div class="product-container">
            <?php foreach ($favorites as $product): ?>
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
                        <form action="/public/removefromfavorites" method="POST" class="favorite-form <?= !$isLoggedIn ? 'login-required' : '' ?>">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']); ?>">
                            <button type="submit" class="btn btn-danger mt-2 favorite-btn">
                                <i class="fa fa-heart"></i>
                            </button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

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
                                window.location.href = "/public/favorite";
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
                window.location.reload();
            }
            window.location.reload();

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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>