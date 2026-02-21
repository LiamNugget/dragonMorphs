<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DragonMorphs - @yield('title', 'Bearded Dragon Breeders')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(64, 114, 0, 0.05) 0%, rgba(64, 114, 0, 0.15) 100%);
            padding-top: 110px;
        }

        /* Sticky Contact Bar - always at top */
        .contact-bar {
            position: fixed;
            top: 0;
            width: 100%;
            background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
            z-index: 101;
            padding: 0.5rem 2rem;
            border-bottom: 2px solid #2d5000;
        }

        .contact-bar-inner {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .contact-bar-text {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .contact-bar-numbers {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .contact-bar-numbers a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Header - shows on scroll up */
        header {
            position: fixed;
            top: 40px;
            width: 100%;
            background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
            z-index: 100;
            padding: 0 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        header.header-hidden {
            transform: translateY(-100%);
        }
        
        .navbar {
            width: 100%;
            height: 70px;
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .navbar .logo a {
            font-size: 1.8rem;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 1px;
            display: block;
        }
        
        .navbar .links {
            display: flex;
            height: 100%;
            align-items: center;
            list-style: none;
            gap: 0.5rem;
        }
        
        .navbar .links li a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            position: relative;
        }

        .navbar .links li a:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .navbar .links li a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .navbar .toggle_btn {
            display: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }
        
        /* Main Container */
        .main_container {
            min-height: calc(100vh - 70px);
            width: 100%;
            max-width: 1400px;
            margin: 0 auto 2rem;
            padding: 2rem;
        }
        
        /* Hero Image */
        .hero_img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .title_text {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            border-radius: 4px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .title_text h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #5a5a5a;
        }
        
        /* Body text weight */
        body, p {
            font-weight: 500;
        }
        
        /* Modern Green Boxes */
        .text_box_green {
            margin: 2rem 0;
            padding: 2.5rem;
            background: linear-gradient(135deg, rgba(64, 114, 0, 0.9) 0%, rgba(94, 167, 0, 0.85) 100%);
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(64, 114, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .text_box_green * {
            color: #ffffff;
            line-height: 1.8;
        }
        
        .text_box_green p {
            font-size: 1.05rem;
        }
        
        hr {
            display: none;
        }
        
        /* Modern Slider */
        .splide {
            margin-top: 2rem;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }
        
        .splide__slide {
            background-color: #ffffff;
        }
        
        .splide__slide img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }
        
        .splide__arrow {
            background: rgba(64, 114, 0, 0.9) !important;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .splide__arrow svg {
            fill: #ffffff !important;
        }

        .splide__arrow:hover {
            background: rgba(94, 167, 0, 1) !important;
            transform: translateY(-50%) !important;
        }
        
        /* Modern Info Section */
        .landing_info {
            display: grid;
            grid-template-columns: 40% 1fr;
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .info_img {
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .info_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .info_desc {
            padding: 2.5rem;
            background: linear-gradient(135deg, rgba(64, 114, 0, 0.9) 0%, rgba(94, 167, 0, 0.85) 100%);
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(64, 114, 0, 0.3);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .info_desc * {
            color: #ffffff;
            line-height: 1.8;
        }
        
        .info_desc p {
            font-size: 1.05rem;
        }
        
        .info_desc p:not(:last-child) {
            margin-bottom: 1.5rem;
        }
        
        .info_desc a {
            color: #ffffff;
            text-decoration: none;
            border-bottom: 2px solid #ffffff;
            transition: opacity 0.3s ease;
            display: inline;
            padding-bottom: 2px;
        }

        .info_desc a:hover {
            opacity: 0.8;
        }
        
        /* Modern Gallery */
        .landing_gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .landing_gallery img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        
        /* Modern Footer */
        .site-footer {
            background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
            padding: 3rem 2rem 2rem;
            margin-top: 4rem;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto 2rem;
        }
        
        .footer-description h2,
        .footer-description p {
            color: #ffffff;
            text-align: left;
        }
        
        .footer-description h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .footer-description p {
            line-height: 1.8;
            opacity: 0.95;
        }
        
        .footer-links {
            text-align: right;
        }
        
        .footer-links h2 {
            color: #ffffff;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        
        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            opacity: 0.8;
        }
        
        .follow-us {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .follow-us h2 {
            color: #ffffff;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .follow-us ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .follow-us a {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .follow-us a:hover {
            background-color: rgba(255, 255, 255, 0.25);
        }
        
        /* Tablet Responsive */
        @media (max-width: 992px) {
            .title_text h1 {
                font-size: 2rem;
            }

            .landing_info {
                grid-template-columns: 1fr;
            }

            .splide__slide img {
                height: 450px;
            }

            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-links {
                text-align: left;
            }

            .landing_gallery {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 96px;
            }

            header {
                padding: 0 1rem;
                top: 36px;
            }

            .navbar {
                height: 60px;
            }

            .contact-bar {
                padding: 0.45rem 1rem;
            }

            .contact-bar-inner {
                flex-direction: row;
                gap: 1.25rem;
                justify-content: center;
            }

            .contact-bar-text {
                display: none;
            }

            .contact-bar-numbers {
                gap: 1.25rem;
            }

            .contact-bar-numbers a {
                font-size: 0.8rem;
            }

            .navbar .logo a {
                font-size: 1.5rem;
            }

            .navbar .links {
                display: none;
            }

            .navbar .toggle_btn {
                display: block;
            }

            .navbar.mobile_nav-active .links {
                display: flex;
                flex-direction: column;
                position: fixed;
                top: 96px;
                left: 0;
                width: 100%;
                height: calc(100vh - 96px);
                background: #407200;
                z-index: 999;
                padding: 1.5rem;
                gap: 0.25rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .navbar.mobile_nav-active .links li {
                width: 100%;
            }

            .navbar.mobile_nav-active .links li a {
                padding: 1rem 1.25rem;
                width: 100%;
                justify-content: flex-start;
                border-radius: 8px;
                font-size: 1.05rem;
            }

            .navbar.mobile_nav-active .links li a:hover,
            .navbar.mobile_nav-active .links li a.active {
                background-color: rgba(255, 255, 255, 0.15);
            }

            .main_container {
                padding: 1rem;
                margin: 0 auto 1rem;
            }

            .title_text {
                padding: 1.5rem;
            }

            .title_text h1 {
                font-size: 1.5rem;
            }

            .text_box_green {
                padding: 1.5rem;
            }

            .text_box_green p {
                font-size: 0.95rem;
            }

            .info_desc {
                padding: 1.5rem;
            }

            .info_desc p {
                font-size: 0.95rem;
            }

            .landing_gallery {
                gap: 0.75rem;
            }

            .landing_gallery img {
                height: 180px;
            }

            .splide__slide img {
                height: 300px;
            }

            .splide__arrow {
                width: 2.5rem;
                height: 2.5rem;
            }

            .site-footer {
                padding: 2rem 1rem 1.5rem;
                margin-top: 2rem;
            }

            .footer-description h2,
            .footer-links h2 {
                font-size: 1.2rem;
            }

            .follow-us a {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
        }

        /* Small Mobile */
        @media (max-width: 480px) {
            .main_container {
                padding: 0.75rem;
            }

            .title_text {
                padding: 1rem;
            }

            .title_text h1 {
                font-size: 1.25rem;
            }

            .text_box_green {
                padding: 1rem;
                margin: 1rem 0;
            }

            .info_desc {
                padding: 1rem;
            }

            .landing_gallery {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .landing_gallery img {
                height: 220px;
            }

            .splide__slide img {
                height: 220px;
            }

            .splide__arrow {
                width: 2rem;
                height: 2rem;
            }

            .hero_img {
                margin-bottom: 1rem;
                border-radius: 4px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar" id="navbar">
            <div class="logo">
                <a href="{{ route('home') }}">DragonMorphs</a>
            </div>
            <ul class="links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('morphs') }}" class="{{ request()->routeIs('morphs') ? 'active' : '' }}"><i class="fas fa-store"></i> Morphs</a></li>
                <li><a href="{{ route('breeding-stock') }}" class="{{ request()->routeIs('breeding-stock') ? 'active' : '' }}"><i class="fas fa-star"></i> Breeding Stock</a></li>
            </ul>
            <div class="toggle_btn" id="mobile_toggle-btn">
                <i class="fa-solid fa-bars" id="mobile_toggle-icon"></i>
            </div>
        </div>
    </header>

    <div class="contact-bar">
        <div class="contact-bar-inner">
            <span class="contact-bar-text">Interested in a dragon? Get in touch!</span>
            <div class="contact-bar-numbers">
                <a href="tel:01516015838"><i class="fas fa-phone"></i> 0151 601 5838</a>
                <a href="tel:07510305180"><i class="fas fa-mobile-screen"></i> 07510 305 180</a>
            </div>
        </div>
    </div>

    <div class="main_container">
        @yield('content')
    </div>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-description">
                <h2><i class="fas fa-info-circle"></i> About Us</h2>
                <p>We are dedicated breeders of bearded dragon colour morphs, working with all the major morphs including Translucents, hypos, leatherbacks and Silkbacks, as well as extreme reds and yellows.</p>
            </div>
            <div class="footer-links">
                <h2><i class="fas fa-link"></i> Quick Links</h2>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="{{ route('morphs') }}"><i class="fas fa-store"></i> Available Morphs</a></li>
                    <li><a href="{{ route('breeding-stock') }}"><i class="fas fa-star"></i> Breeding Stock</a></li>
                </ul>
            </div>
        </div>
        <div class="follow-us">
            <h2><i class="fas fa-share-alt"></i> Follow Us</h2>
            <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            </ul>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById("navbar");
        const mobileMenu = document.getElementById("mobile_toggle-btn");
        const toggleIcon = document.getElementById("mobile_toggle-icon");
        const header = document.querySelector("header");

        // Mobile menu toggle
        mobileMenu.addEventListener("click", () => {
            navbar.classList.toggle("mobile_nav-active");
            if (navbar.classList.contains("mobile_nav-active")) {
                toggleIcon.classList.remove("fa-bars");
                toggleIcon.classList.add("fa-xmark");
                header.classList.remove("header-hidden");
            } else {
                toggleIcon.classList.remove("fa-xmark");
                toggleIcon.classList.add("fa-bars");
            }
        });

        // Show header on scroll up, hide on scroll down
        let lastScrollY = window.scrollY;
        let ticking = false;

        window.addEventListener("scroll", () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const currentScrollY = window.scrollY;
                    if (currentScrollY < lastScrollY || currentScrollY < 50) {
                        header.classList.remove("header-hidden");
                    } else if (currentScrollY > lastScrollY && !navbar.classList.contains("mobile_nav-active")) {
                        header.classList.add("header-hidden");
                    }
                    lastScrollY = currentScrollY;
                    ticking = false;
                });
                ticking = true;
            }
        });
    </script>
</body>
</html>