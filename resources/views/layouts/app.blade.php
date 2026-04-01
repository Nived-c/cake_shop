<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cake Atelier | Premium Custom Cakes')</title>
    <meta name="description" content="@yield('meta_description', 'Premium custom cakes, pastries and baked goods. Order online for delivery or pickup.')">

    <!-- Google Fonts: Signika & Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Signika:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ===== DESIGN TOKENS (Original Blush Pink & Charcoal) ===== */
        :root {
            --maroon:        #D48B96;   /* Soft Blush Pink  */
            --maroon-dark:   #2F2A32;   /* Dark Charcoal Plum (nav/footer) */
            --maroon-light:  #E0A0AB;   /* Lighter pink */
            --gold:          #D4AF37;   /* Accent Gold */
            --gold-light:    #E2C35A;
            --cream:         #FDFCFB;   /* Off-white background */
            --cream-dark:    #F5EFF0;   /* Subtle pinkish dividers */
            --white:         #ffffff;
            --text-dark:     #2F2A32;   /* Charcoal heading text */
            --text-mid:      #675D6E;
            --text-light:    #9A8FA0;
            --nav-height:    72px;
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
        }

        a { text-decoration: none; color: inherit; }
        img { display: block; max-width: 100%; }

        /* ===== TOP ANNOUNCEMENT BAR ===== */
        .top-bar {
            background: var(--gold);
            color: var(--white);
            text-align: center;
            padding: 8px 16px;
            font-size: 13px;
            font-family: 'Signika', sans-serif;
            font-weight: 500;
            letter-spacing: 0.03em;
        }
        .top-bar a { color: var(--white); font-weight: 700; }

        /* ===== HEADER / NAVBAR ===== */
        header {
            background: var(--maroon);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(101, 6, 50, 0.35);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            height: var(--nav-height);
            gap: 24px;
        }

        /* Logo box */
        .logo-box {
            background: var(--white);
            border-radius: 0 0 20px 0;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
            flex-shrink: 0;
            margin-top: 0;
        }
        .logo-box .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--maroon);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }
        .logo-box .logo-text {
            font-family: 'Signika', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--maroon);
            line-height: 1.1;
        }
        .logo-box .logo-tagline {
            font-size: 10px;
            color: var(--gold);
            font-family: 'Signika', sans-serif;
            font-weight: 400;
        }

        /* Nav Links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
            flex: 1;
        }
        .nav-links li { position: relative; }
        .nav-links a {
            font-family: 'Signika', sans-serif;
            font-weight: 500;
            font-size: 15px;
            color: var(--white);
            padding: 8px 14px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.25s;
            white-space: nowrap;
        }
        .nav-links a:hover,
        .nav-links a.active { color: var(--gold); }
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            border-radius: 2px;
            background: var(--gold);
        }

        /* Dropdown */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            left: 0;
            background: var(--cream);
            min-width: 210px;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(101, 6, 50, 0.2);
            padding: 8px 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.25s ease;
            z-index: 999;
        }
        .nav-links li:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-menu a {
            color: var(--text-dark) !important;
            font-size: 14px;
            padding: 10px 20px;
            display: block;
            border-bottom: 1px solid rgba(101,6,50,0.08);
            border-radius: 0;
            transition: all 0.2s;
        }
        .dropdown-menu a:last-child { border-bottom: none; }
        .dropdown-menu a:hover { background: var(--maroon); color: var(--white) !important; }

        /* WhatsApp button */
        .whatsapp-btn {
            background: var(--gold);
            color: var(--white);
            font-family: 'Signika', sans-serif;
            font-weight: 600;
            font-size: 13px;
            border-radius: 8px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            transition: background 0.25s, transform 0.2s;
            flex-shrink: 0;
        }
        .whatsapp-btn:hover { background: #a07a20; transform: scale(1.02); }
        .whatsapp-btn .wa-icon {
            background: white;
            color: var(--gold);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        /* Mobile hamburger */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
        }

        /* ===== DRIP SEPARATOR (chocolate drip effect) ===== */
        .drip-separator {
            width: 100%;
            line-height: 0;
            display: block;
            position: relative;
            z-index: 1;
        }
        .drip-separator svg {
            width: 100%;
            height: 80px;
        }
        .drip-top { /* maroon drips downward onto cream */ }
        .drip-bottom { /* maroon drips upward onto cream */ transform: scaleY(-1); }

        /* ===== SECTION HELPERS ===== */
        .container { max-width: 1280px; margin: 0 auto; padding: 0 24px; }
        .section-title {
            font-family: 'Signika', sans-serif;
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 700;
            color: var(--maroon);
            text-align: center;
            margin-bottom: 12px;
        }
        .section-subtitle {
            font-size: 15px;
            color: var(--text-mid);
            text-align: center;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }
        .section-underline {
            width: 60px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            margin: 10px auto 20px;
        }

        /* ===== GOLD BUTTON ===== */
        .btn-gold {
            display: inline-block;
            background: transparent;
            color: var(--gold);
            border: 2px solid var(--gold);
            font-family: 'Signika', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 32px;
            border-radius: 4px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-gold:hover {
            background: var(--gold);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(189, 150, 46, 0.4);
        }
        .btn-maroon {
            display: inline-block;
            background: var(--maroon);
            color: white;
            border: 2px solid var(--maroon);
            font-family: 'Signika', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 32px;
            border-radius: 4px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-maroon:hover {
            background: var(--maroon-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(101, 6, 50, 0.4);
        }

        /* ===== PRODUCT CARD (homepage grid) ===== */
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(101, 6, 50, 0.1);
            transition: all 0.35s ease;
        }
        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(101, 6, 50, 0.2);
        }
        .product-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }
        .product-card-body {
            padding: 16px;
            background: var(--maroon);
        }
        .product-card-body h3 {
            font-family: 'Signika', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 4px;
        }
        .product-card-body p {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }
        .product-card-body .price {
            color: var(--gold-light);
            font-weight: 700;
            font-size: 15px;
        }

        /* ===== PRODUCT CARD LG (products listing & detail) ===== */
        .product-card-lg {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(101, 6, 50, 0.08);
            transition: all 0.35s ease;
            display: flex;
            flex-direction: column;
        }
        .product-card-lg:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(101, 6, 50, 0.18);
        }
        .product-card-lg .card-img-wrap {
            position: relative;
            overflow: hidden;
        }
        .product-card-lg img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }
        .product-card-lg:hover img { transform: scale(1.06); }
        .product-card-lg .card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--gold);
            color: white;
            font-family: 'Signika', sans-serif;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .product-card-lg .card-body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-card-lg .card-category {
            font-size: 11px;
            color: var(--gold);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 4px;
        }
        .product-card-lg .card-title {
            font-family: 'Signika', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--maroon);
            margin-bottom: 6px;
        }
        .product-card-lg .card-desc {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.6;
            flex: 1;
            margin-bottom: 12px;
        }
        .product-card-lg .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid var(--cream-dark);
        }
        .product-card-lg .card-price {
            font-family: 'Signika', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--maroon);
        }
        .card-order-btn {
            background: var(--maroon);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 7px 14px;
            font-size: 12px;
            font-family: 'Signika', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .card-order-btn:hover { background: var(--gold); color: white; }

        /* ===== FOOTER ===== */
        footer {
            background: var(--maroon-dark);
            color: white;
            padding: 56px 0 0;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr 1fr;
            gap: 40px;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px 48px;
        }
        .footer-logo-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-align: center;
        }
        .footer-logo-box .logo-text {
            font-family: 'Signika', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--maroon);
        }
        .footer-logo-box .logo-tagline { color: var(--gold); font-size: 12px; }
        .footer-section h4 {
            font-family: 'Signika', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 16px;
        }
        .footer-section h4::after {
            content: '';
            display: block;
            width: 40px;
            height: 2px;
            background: var(--gold);
            margin-top: 8px;
            border-radius: 1px;
        }
        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 10px; }
        .footer-section ul li a {
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            transition: color 0.2s;
        }
        .footer-section ul li a:hover { color: var(--gold); }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 18px;
        }
        .footer-contact-icon {
            color: var(--gold);
            font-size: 18px;
            margin-top: 2px;
            flex-shrink: 0;
        }
        .footer-contact-title {
            font-family: 'Signika', sans-serif;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--gold);
            margin-bottom: 2px;
        }
        .footer-contact-item p, .footer-contact-item a {
            font-size: 14px;
            color: rgba(255,255,255,0.8);
            line-height: 1.6;
        }
        .footer-social { display: flex; gap: 12px; margin-top: 16px; }
        .footer-social a {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            transition: all 0.25s;
        }
        .footer-social a:hover { border-color: var(--gold); color: var(--gold); }
        .footer-bottom {
            background: rgba(0,0,0,0.25);
            text-align: center;
            padding: 16px;
            font-size: 13px;
            color: rgba(255,255,255,0.55);
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .hamburger { display: block; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
            .whatsapp-btn span { display: none; }
        }

        /* Mobile nav overlay */
        .mobile-nav {
            display: none;
            position: fixed;
            inset: 0;
            background: var(--maroon-dark);
            z-index: 2000;
            flex-direction: column;
            padding: 30px 24px;
            gap: 0;
        }
        .mobile-nav.open { display: flex; }
        .mobile-nav .close-btn {
            align-self: flex-end;
            background: none;
            border: none;
            color: white;
            font-size: 28px;
            cursor: pointer;
            margin-bottom: 30px;
        }
        .mobile-nav a {
            font-family: 'Signika', sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: white;
            padding: 16px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .mobile-nav a:hover { color: var(--gold); }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Top Announcement Bar -->
    <div class="top-bar">
        🎂 Free Delivery on Wedding &amp; Event Cakes &nbsp;•&nbsp; Order 24hrs in advance &nbsp;•&nbsp;
        <a href="tel:+919895588988">Call: +91 98955 88988</a>
    </div>

    <!-- Header / Navbar -->
    <header>
        <div class="nav-inner">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo-box">
                <div class="logo-icon"><i class="fa-solid fa-cake-candles"></i></div>
                <div>
                    <div class="logo-text">Cake Atelier</div>
                    <div class="logo-tagline">...It's all about cakes</div>
                </div>
            </a>

            <!-- Desktop Nav -->
            <ul class="nav-links">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                        Products <i class="fa-solid fa-chevron-down fa-xs"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ route('products.index') }}">All Products</a>
                        <a href="{{ route('products.index', ['category' => 'cakes']) }}">Cakes</a>
                        <a href="{{ route('products.index', ['category' => 'pastries']) }}">Pastries</a>
                        <a href="{{ route('products.index', ['category' => 'cupcakes']) }}">Cupcakes</a>
                        <a href="{{ route('products.index', ['category' => 'desserts']) }}">Desserts</a>
                    </div>
                </li>
                <li>
                    <a href="{{ route('customized') }}" class="{{ request()->routeIs('customized') ? 'active' : '' }}">
                        Customized Cakes
                    </a>
                </li>
                <li>
                    <a href="{{ route('delivery') }}" class="{{ request()->routeIs('delivery') ? 'active' : '' }}">
                        Delivery
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                        Contact Us
                    </a>
                </li>
            </ul>

            <!-- WhatsApp CTA -->
            <a href="https://wa.me/919895588988" target="_blank" class="whatsapp-btn">
                <span>Order now on WhatsApp<br><strong>+91 98955 88988</strong></span>
                <div class="wa-icon"><i class="fa-brands fa-whatsapp"></i></div>
            </a>

            <!-- Hamburger (mobile) -->
            <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Mobile Overlay Nav -->
    <div class="mobile-nav" id="mobileNav">
        <button class="close-btn" id="closeNavBtn"><i class="fa-solid fa-xmark"></i></button>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('products.index') }}">Products</a>
        <a href="{{ route('customized') }}">Customized Cakes</a>
        <a href="{{ route('delivery') }}">Delivery</a>
        <a href="{{ route('contact') }}">Contact Us</a>
    </div>

    <!-- Page Content -->
    @yield('content')

    <!-- ===== FOOTER ===== -->
    <!-- Drip transition into footer -->
    <div class="drip-separator drip-bottom" style="background:var(--cream);">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 L0,40 Q40,80 80,40 Q120,0 160,40 Q200,80 240,50 Q280,20 320,50 Q360,80 400,45 Q440,10 480,45 Q520,80 560,50 Q600,20 640,50 Q680,80 720,45 Q760,10 800,45 Q840,80 880,50 Q920,20 960,45 Q1000,70 1040,40 Q1080,10 1120,45 Q1160,80 1200,50 Q1240,20 1280,45 Q1320,70 1360,40 Q1400,10 1440,40 L1440,0 Z"
                fill="var(--maroon-dark)"/>
        </svg>
    </div>

    <footer>
        <div class="footer-grid">
            <!-- Logo col -->
            <div>
                <div class="footer-logo-box">
                    <div style="font-size:48px;color:var(--maroon)">🎂</div>
                    <div class="logo-text">Cake Atelier</div>
                    <div class="logo-tagline">...It's all about cakes</div>
                </div>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('customized') }}">Customized Cakes</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-section">
                <h4>Get in Touch</h4>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot footer-contact-icon"></i>
                    <div>
                        <div class="footer-contact-title">Cake Atelier</div>
                        <p>123 Baker's Lane, MG Road<br>Kochi, Kerala - 682001</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone footer-contact-icon"></i>
                    <div>
                        <div class="footer-contact-title">Call Us</div>
                        <p>Tel: 0484 2767660<br>Mob: +91 98955 88988</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope footer-contact-icon"></i>
                    <div>
                        <div class="footer-contact-title">Mail Us</div>
                        <a href="mailto:hello@cakeatelier.in">hello@cakeatelier.in</a>
                    </div>
                </div>
            </div>

            <!-- Follow Us -->
            <div class="footer-section">
                <h4>Follow Us</h4>
                <p style="color:rgba(255,255,255,0.7);font-size:14px;line-height:1.7;margin-bottom:16px;">
                    Follow us on social media for daily specials, behind-the-scenes baking and new arrivals.
                </p>
                <a href="https://wa.me/919895588988" target="_blank" class="btn-gold" style="font-size:13px;padding:10px 20px;">
                    <i class="fa-brands fa-whatsapp"></i> Order on WhatsApp
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Cake Atelier. All rights reserved.
        </div>
    </footer>

    <!-- Mobile Nav Script -->
    <script>
        document.getElementById('hamburgerBtn').addEventListener('click', function () {
            document.getElementById('mobileNav').classList.add('open');
        });
        document.getElementById('closeNavBtn').addEventListener('click', function () {
            document.getElementById('mobileNav').classList.remove('open');
        });
    </script>

    @stack('scripts')
</body>
</html>
