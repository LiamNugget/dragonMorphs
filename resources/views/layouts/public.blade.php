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
            padding-top: 70px;
        }
        
        /* Modern Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
            z-index: 100;
            padding: 0 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
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
            transition: transform 0.3s ease;
            display: block;
        }
        
        .navbar .logo a:hover {
            transform: scale(1.05);
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
            transition: all 0.3s ease;
            position: relative;
        }
        
        .navbar .links li a:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
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
            transition: transform 0.3s ease;
        }
        
        .navbar .toggle_btn:hover {
            transform: scale(1.1);
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
            transition: transform 0.3s ease;
        }
        
        .hero_img:hover {
            transform: scale(1.02);
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
            transition: transform 0.5s ease;
        }
        
        .splide__slide:hover img {
            transform: scale(1.05);
        }
        
        .splide__arrow {
            background: rgba(64, 114, 0, 0.9) !important;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .splide__arrow svg {
            fill: #ffffff !important;
        }
        
        .splide__arrow:hover {
            background: rgba(94, 167, 0, 1) !important;
            transform: scale(1.1);
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
            transition: transform 0.3s ease;
        }
        
        .info_img:hover {
            transform: translateY(-5px);
        }
        
        .info_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .info_img:hover img {
            transform: scale(1.1);
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
            transition: all 0.3s ease;
            display: inline;
            padding-bottom: 2px;
        }
        
        .info_desc a:hover {
            border-bottom-color: rgba(255, 255, 255, 0.5);
            padding-bottom: 4px;
        }
        
        /* Modern Gallery */
        .landing_gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .landing_gallery img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .landing_gallery img:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.25);
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
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .footer-links a:hover {
            transform: translateX(-5px);
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
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .follow-us a:hover {
            background-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px) scale(1.1);
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 60px;
            }
            
            header {
                padding: 0 1rem;
            }
            
            .navbar {
                height: 60px;
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
                top: 60px;
                left: 0;
                width: 100%;
                background: linear-gradient(135deg, #407200 0%, #5ea700 100%);
                z-index: 99;
                padding: 1rem;
                gap: 0;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }
            
            .navbar.mobile_nav-active .links li {
                width: 100%;
            }
            
            .navbar.mobile_nav-active .links li a {
                padding: 1rem;
                width: 100%;
                justify-content: center;
                border-radius: 4px;
            }
            
            .main_container {
                padding: 1rem;
                margin: 0 auto 1rem;
            }
            
            .title_text h1 {
                font-size: 1.8rem;
            }
            
            .text_box_green {
                padding: 1.5rem;
            }
            
            .landing_info {
                grid-template-columns: 1fr;
            }
            
            .info_desc {
                padding: 1.5rem;
            }
            
            .landing_gallery {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 1rem;
            }
            
            .landing_gallery img {
                height: 200px;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .footer-links {
                text-align: left;
            }
            
            .splide__slide img {
                height: 400px;
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
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
    </header>

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

        mobileMenu.addEventListener("click", () => {
            navbar.classList.toggle("mobile_nav-active");
        });
    </script>
</body>
</html>