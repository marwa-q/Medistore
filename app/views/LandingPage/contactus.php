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
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <!-- Brand and Social Links -->
                <div class="col-md-9 col-sm-12 mb-4">
                    <div class="content">
                        <a href="#" class="text-decoration-none">
                            <h2 class="text-white">Medestore</h2>
                        </a>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint, magni.
                        </p>
                        <div class="social-list">
                            <a href="#" class="text-white me-3">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a href="#" class="text-white me-3">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="#" class="text-white">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3 col-sm-12">
                    <div class="content">
                        <p class="fw-bold">Medestore</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="html/aboutus.html" class="text-white text-decoration-none">About us</a></li>
                            <li class="mb-2"><a href="pages/profile.html" class="text-white text-decoration-none">My profile</a></li>
                            <li class="mb-2"><a href="html/aboutus.html" class="text-white text-decoration-none">Services</a></li>
                            <li><a href="pages/contactUs.html" class="text-white text-decoration-none">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright Section -->
    <div class="bg-black text-white text-center py-3">
        &copy; 2025 Medistore | All Rights Reserved
    </div>
    <script>
        window.onload = function() {
            document.getElementById("form").reset(); // Clear fields on load
        };
    </script>
</body>

</html>