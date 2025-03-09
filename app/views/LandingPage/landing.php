<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app/views/NavBar/nav.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        .favorite-btn {
            background: none;
            color: #e50000;
            font-size: 1rem;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .favorite-btn i {
            margin-right: 0px;
        }

        /* Hide Swiper on mobile devices */
        @media (max-width: 768px) {
            .swiper-container {
                display: none;
                /* Hide the Swiper container */
            }
        }

        /* Ensure Swiper is visible on larger screens */
        @media (min-width: 769px) {
            .swiper-container {
                display: block;
                /* Show the Swiper container */
            }
        }
    </style>
</head>

<body>
    <section class="main-section">
        <!-- Main Content -->
        <main class="main_content">
            <div class="main_text">
                <h2>MediStore</h2>
                <p class="main-p">Reliable Medical Supplies, Anytime, Anywhere.</p>
            </div>

            <div class="button">
                <a href="/public/product">Shop Now</a>
                <i class="fa-solid fa-chevron-right"></i>
            </div>
        </main>

        <!-- Swiper Container -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="/app/views/LandingPage/img/acc2.png" alt="Image 1"></div>
                <div class="swiper-slide"><img src="/app/views/LandingPage/img/Acc.jpg" alt="Image 2"></div>
                <div class="swiper-slide"><img style="background: radial-gradient(circle, #e0eff8 40%, #b2d2ea 100%);" src="/app/views/LandingPage/img/blacscrap-removebg-preview.png" alt=""></div>
                <div class="swiper-slide"><img src="https://images.pexels.com/photos/12585206/pexels-photo-12585206.jpeg" alt="Image 1"></div>
            </div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true, // Infinite loop
            autoplay: {
                delay: 3000, // Auto-slide every 3 seconds
                disableOnInteraction: false // Keep autoplay even after user interaction
            },
            effect: "fade", // Smooth fading transition
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>

</html>