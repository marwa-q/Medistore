<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/app/views/LandingPage/aboutme.css">

    <link rel="stylesheet" href="/app/views/LandingPage/contact.css">
    <link rel="stylesheet" href="/app/views/Navbar/nav.css">
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

    <!-- Hero Section -->
    <section id="contact-hero">
        <div class="hero-content">
            <h1>Contact Us</h1>
            <p>Have a question or feedback? We're here to help!</p>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact-form">
        <div id="form-box">
            <h2><strong>Get in Touch</strong></h2>
            <p>If you have any questions, suggestions, or need support, please don't hesitate to contact us. We'll get back to you as soon as possible!</p>

            <form id="form" action="https://api.web3forms.com/submit" method="POST">
                <input type="hidden" name="access_key" value="f7f8861f-d9d8-4099-a41b-86e33b39bc2b">
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" name="subject" required placeholder="Enter subject">
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" rows="5" required placeholder="Write your message here"></textarea>
                </div>

                <button type="submit" class="cta-button">Send Message</button>
            </form>
        </div>
    </section>

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
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint,
                            magni.
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
                                    <li><a href="html/aboutus.html">About us</a></li>
                                    <li><a href="pages/profile.html">My profile</a></li>
                                    <li><a href="html/aboutus.html">Services</a></li>
                                    <li><a href="pages/contactUs.html">Contact Us</a></li>
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

    <!-- Copyright Section -->

    <script>
        window.onload = function() {
            document.getElementById("form").reset(); // Clear fields on load
        };
    </script>
</body>

</html>