<head>
    <style>
        /* start FOOTER SECTION *******************************************/

        footer.section {
            background-color: #1e3a8a;
            /* لون أزرق غامق */
            color: white;
            padding: 50px 0;
        }

        footer .container {
            max-width: 1200px;
            margin: auto;
        }

        footer .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        /* تنسيق القسم الأول (الشعار + الوصف + السوشيال ميديا) */
        footer .logo h2 {
            font-size: 28px;
            font-weight: bold;
            color: #009cff;
            /* لون متناسق */
        }

        footer .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-top: 10px;
            max-width: 400px;
        }

        /* تنسيق أيقونات التواصل الاجتماعي */
        .social-list {
            margin-top: 15px;
        }

        .social-item {
            display: inline-block;
            font-size: 22px;
            margin-right: 10px;
            color: white;
            transition: color 0.3s ease-in-out;
        }

        .social-item:hover {
            color: #009cff;
            /* تغيير اللون عند تمرير الماوس */
        }

        /* تنسيق قائمة الروابط */
        .footer-menu {
            list-style: none;
            padding: 0;
        }

        .footer-menu li {
            margin-bottom: 8px;
        }

        .footer-menu a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease-in-out;
        }

        .footer-menu a:hover {
            color: #009cff;
            /* تغيير اللون عند تمرير الماوس */
        }

        /* تنسيق حقوق النشر */
        .copyright {
            text-align: center;
            background-color: #162a5a;
            /* أزرق غامق أكثر */
            color: white;
            padding: 15px 0;
            font-size: 14px;
        }

        /* ✅ Responsive Design */

/* For tablets (max-width: 768px) */
@media (max-width: 768px) {
    footer .row {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .col-9, .col-3 {
        width: 100%;
        text-align: center;
    }

    .social-list {
        justify-content: center;
    }

    .footer-menu {
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
}

/* For mobile (max-width: 480px) */
@media (max-width: 480px) {
    footer {
        padding: 30px 10px;
    }

    .social-list {
        flex-direction: row;
        justify-content: center;
    }

    .social-item {
        font-size: 18px;
    }
}

    </style>
</head>
<!-- ٍstart FOOTER SECTION -->
<footer class="section">
    <div class="container">
        <div class="row">
            <div class="col-9 col-md-9 col-sm-12">
                <div class="content" style="text-align: start;">
                    <a href="#" class="logo">
                        <h2>Medistore</h2>
                    </a>
                    <p>
                        Reliable Medical Supplies, Anytime, Anywhere
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
                        <div class="content" style="text-align: start;">
                            <p><b>Medistore</b></p>
                            <ul class="footer-menu">
                                <li><a href="/public/aboutus">About us</a></li>
                                <li><a href="/public/profile">My profile</a></li>
                                <li><a href="/public/aboutus">Services</a></li>
                                <li><a href="/public/contactus">Contact Us</a></li>
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