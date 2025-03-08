<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app/views/NavBar/nav.css">
    <!-- تضمين مكتبة Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- تضمين مكتبة Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
         
    </style>

</head>

<body>
    <section class="main-section">
        <!-- محتوى النص -->
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

         <!-- سلايدر الصور
         <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="https://media.zid.store/f628e75e-d909-47fd-8141-0db600326e6a/2021c1ad-0ec0-45b8-85d3-36dc388d7cb5.jpg" alt="Image 1"></div>
                <div class="swiper-slide"><img style="background:  linear-gradient(to bottom, rgba(176, 210, 235, 0.7) 0%, rgba(255, 255, 255, 0.4) 50%, rgba(176, 210, 235, 0.7) 100%), ;" src="img/شسيبلات-removebg-preview.png" alt="Image 2"></div>
                <div class="swiper-slide"><img style="background: radial-gradient(circle, #e0eff8 40%, #b2d2ea 100%);" src="img/blacscrap-removebg-preview.png" alt=""></div>
                <div class="swiper-slide"><img src="https://images.pexels.com/photos/12585206/pexels-photo-12585206.jpeg" alt="Image 1"></div>
            </div>

            الأسهم للتحكم
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div> -->
    </section>
</body>

</html>