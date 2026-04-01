<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cake Atelier | Premium Custom Cakes')</title>
    <meta name="description" content="@yield('meta_description', 'Premium custom cakes, pastries and baked goods. Order online for delivery or pickup.')">

    <!-- Google Fonts: Playfair Display + Jost -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    /* ===== DESIGN TOKENS (Lollino-inspired) ===== */
    :root {
        --teal:         #286a73;
        --teal-dark:    #1e5059;
        --teal-light:   #3a8a95;
        --red:          #e33e4f;
        --white:        #ffffff;
        --off-white:    #f5f5f5;
        --light-gray:   #e8e8ea;
        --mid-gray:     #999999;
        --dark:         #111111;
        --body:         #333333;
        --muted:        #666666;
        --border:       #e0e0e0;
    }

    /* ===== RESET ===== */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Jost', sans-serif; background: var(--white); color: var(--body); line-height: 1.6; }
    a { text-decoration: none; color: inherit; }
    img { display: block; max-width: 100%; }
    ul { list-style: none; }

    /* ===== TOP BAR ===== */
    .top-bar {
        background: var(--teal);
        color: var(--white);
        padding: 8px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 400;
        letter-spacing: 0.02em;
    }
    .top-bar-left { display: flex; align-items: center; gap: 16px; }
    .top-bar-left i { font-size: 18px; opacity: 0.85; }
    .top-bar-center { display: flex; align-items: center; gap: 20px; }
    .top-bar-center a { color: white; opacity: 0.85; font-size: 15px; transition: opacity 0.2s; }
    .top-bar-center a:hover { opacity: 1; }
    .top-bar-right a {
        color: white;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        opacity: 0.9;
        transition: opacity 0.2s;
    }
    .top-bar-right a:hover { opacity: 1; }

    /* ===== MAIN NAVBAR ===== */
    .main-header {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .nav-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px;
        display: flex;
        align-items: center;
        height: 80px;
        gap: 32px;
    }

    /* Logo */
    .logo {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        flex-shrink: 0;
        text-decoration: none;
    }
    .logo-name {
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--teal);
        line-height: 1;
        letter-spacing: -0.03em;
    }
    .logo-sub {
        font-family: 'Jost', sans-serif;
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 0.25em;
        color: var(--muted);
        text-transform: uppercase;
        margin-top: 3px;
    }

    /* Nav Links */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 4px;
        flex: 1;
    }
    .nav-links li { position: relative; }
    .nav-links > li > a {
        font-family: 'Jost', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: var(--dark);
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.2s;
        white-space: nowrap;
    }
    .nav-links > li > a:hover,
    .nav-links > li > a.active { color: var(--teal); }
    .nav-links > li > a i { font-size: 10px; opacity: 0.6; }

    /* Dropdown */
    .nav-dropdown {
        position: absolute;
        top: calc(100% + 1px);
        left: 0;
        background: var(--white);
        min-width: 200px;
        border: 1px solid var(--border);
        border-top: 2px solid var(--teal);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-6px);
        transition: all 0.22s ease;
        z-index: 999;
    }
    .nav-links li:hover .nav-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .nav-dropdown a {
        display: block;
        padding: 10px 18px;
        font-size: 13px;
        color: var(--body);
        border-bottom: 1px solid var(--border);
        transition: all 0.18s;
    }
    .nav-dropdown a:last-child { border-bottom: none; }
    .nav-dropdown a:hover { background: var(--off-white); color: var(--teal); padding-left: 24px; }

    /* Nav Icons (right side) */
    .nav-icons {
        display: flex;
        align-items: center;
        gap: 18px;
        flex-shrink: 0;
    }
    .nav-icon-btn {
        position: relative;
        color: var(--dark);
        font-size: 19px;
        cursor: pointer;
        transition: color 0.2s;
        background: none;
        border: none;
    }
    .nav-icon-btn:hover { color: var(--teal); }
    .nav-icon-badge {
        position: absolute;
        top: -6px;
        right: -8px;
        background: var(--teal);
        color: white;
        font-size: 10px;
        font-weight: 700;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .nav-whatsapp-btn {
        background: var(--teal);
        color: white;
        font-family: 'Jost', sans-serif;
        font-size: 13px;
        font-weight: 600;
        padding: 9px 20px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
        white-space: nowrap;
    }
    .nav-whatsapp-btn:hover { background: var(--teal-dark); }

    /* Mobile hamburger */
    .hamburger {
        display: none;
        background: none;
        border: none;
        font-size: 22px;
        color: var(--dark);
        cursor: pointer;
        padding: 4px;
    }

    /* ===== SECTION HELPERS ===== */
    .container { max-width: 1280px; margin: 0 auto; padding: 0 32px; }
    .section-label {
        font-family: 'Jost', sans-serif;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--teal);
        margin-bottom: 10px;
        display: block;
    }
    .section-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(28px, 4vw, 46px);
        font-weight: 400;
        color: var(--dark);
        line-height: 1.2;
        margin-bottom: 20px;
    }
    .section-text {
        font-size: 15px;
        color: var(--muted);
        line-height: 1.8;
        max-width: 560px;
    }
    .teal-divider {
        width: 48px;
        height: 2px;
        background: var(--teal);
        margin-bottom: 24px;
    }

    /* ===== BUTTONS ===== */
    .btn-teal {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--teal);
        color: white;
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.06em;
        padding: 13px 30px;
        border-radius: 4px;
        border: 2px solid var(--teal);
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-teal:hover { background: var(--teal-dark); border-color: var(--teal-dark); transform: translateY(-1px); }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: var(--teal);
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.06em;
        padding: 11px 28px;
        border-radius: 4px;
        border: 2px solid var(--teal);
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-outline:hover { background: var(--teal); color: white; transform: translateY(-1px); }

    .btn-dark {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--dark);
        color: white;
        font-family: 'Jost', sans-serif;
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.06em;
        padding: 13px 30px;
        border-radius: 4px;
        border: 2px solid var(--dark);
        transition: all 0.25s;
        cursor: pointer;
    }
    .btn-dark:hover { background: var(--teal); border-color: var(--teal); }

    /* ===== PAGE BANNER (inner pages) ===== */
    .page-banner {
        background: var(--light-gray);
        padding: 64px 32px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }
    .page-banner h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(36px, 6vw, 72px);
        font-weight: 400;
        color: var(--dark);
        line-height: 1;
        letter-spacing: -0.02em;
    }
    .page-breadcrumb {
        font-size: 13px;
        color: var(--muted);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .page-breadcrumb a { color: var(--teal); }
    .page-breadcrumb a:hover { text-decoration: underline; }
    .page-breadcrumb .sep { color: var(--mid-gray); }

    /* ===== PRODUCT CARD (Lollino style) ===== */
    .product-card {
        background: var(--white);
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    .product-card:hover { transform: translateY(-4px); }
    .product-card-img {
        background: var(--off-white);
        aspect-ratio: 1/1;
        overflow: hidden;
        margin-bottom: 14px;
        position: relative;
    }
    .product-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-card-img img { transform: scale(1.06); }
    .product-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--red);
        color: white;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 2px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .product-card-cat {
        font-family: 'Jost', sans-serif;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 5px;
    }
    .product-card-name {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 400;
        color: var(--dark);
        margin-bottom: 6px;
        line-height: 1.3;
    }
    .product-card-price {
        font-family: 'Jost', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: var(--dark);
    }

    /* ===== FOOTER ===== */
    footer {
        background: var(--teal);
        color: white;
        padding: 64px 0 0;
    }
    .footer-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px 52px;
        display: grid;
        grid-template-columns: 1.4fr 1fr 1.6fr 1fr;
        gap: 48px;
    }
    .footer-brand .logo-name { color: white; font-size: 36px; }
    .footer-brand .logo-sub { color: rgba(255,255,255,0.6); }
    .footer-brand p {
        font-size: 14px;
        color: rgba(255,255,255,0.75);
        line-height: 1.8;
        margin-top: 16px;
        max-width: 260px;
    }
    .footer-social { display: flex; gap: 12px; margin-top: 20px; }
    .footer-social a {
        width: 36px;
        height: 36px;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        transition: all 0.2s;
    }
    .footer-social a:hover { border-color: white; color: white; background: rgba(255,255,255,0.1); }
    .footer-col h4 {
        font-family: 'Jost', sans-serif;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: white;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    .footer-col ul li { margin-bottom: 10px; }
    .footer-col ul li a {
        font-size: 14px;
        color: rgba(255,255,255,0.72);
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .footer-col ul li a:hover { color: white; padding-left: 4px; }
    .footer-contact-item {
        display: flex;
        gap: 12px;
        margin-bottom: 14px;
        align-items: flex-start;
    }
    .footer-contact-item i {
        font-size: 15px;
        color: rgba(255,255,255,0.6);
        margin-top: 2px;
        flex-shrink: 0;
    }
    .footer-contact-item span {
        font-size: 14px;
        color: rgba(255,255,255,0.75);
        line-height: 1.6;
    }
    .footer-contact-item a { color: rgba(255,255,255,0.75); }
    .footer-contact-item a:hover { color: white; }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.15);
        text-align: center;
        padding: 18px 32px;
        font-size: 13px;
        color: rgba(255,255,255,0.5);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .footer-inner { grid-template-columns: 1fr 1fr; }
        .top-bar-center { display: none; }
    }
    @media (max-width: 860px) {
        .nav-links { display: none; }
        .hamburger { display: block; }
        .nav-whatsapp-btn span { display: none; }
    }
    @media (max-width: 600px) {
        .footer-inner { grid-template-columns: 1fr; gap: 32px; }
        .top-bar { flex-wrap: wrap; gap: 6px; }
        .page-banner { flex-direction: column; align-items: flex-start; gap: 12px; }
    }

    /* Mobile Nav */
    .mobile-nav {
        display: none;
        position: fixed;
        inset: 0;
        background: var(--white);
        z-index: 2000;
        flex-direction: column;
        padding: 24px;
        overflow-y: auto;
    }
    .mobile-nav.open { display: flex; }
    .mobile-nav-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }
    .mobile-nav a {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        color: var(--dark);
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
        display: block;
    }
    .mobile-nav a:hover { color: var(--teal); }
    .mobile-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--dark);
    }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ===== TOP BAR ===== -->
    <div class="top-bar">
        <div class="top-bar-left">
            <i class="fa-regular fa-clock"></i>
            <div>
                <div style="font-weight:600;">10AM TO 10PM</div>
                <div>Call: +91 98955 88988</div>
            </div>
        </div>
        <div class="top-bar-center">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
        <div class="top-bar-right">
            <a href="#"><i class="fa-regular fa-user"></i> Log in / Register</a>
        </div>
    </div>

    <!-- ===== MAIN NAVBAR ===== -->
    <header class="main-header">
        <div class="nav-container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-name">Cake Atelier</span>
                <span class="logo-sub">Cakes &bull; Pastries &bull; Desserts</span>
            </a>

            <!-- Desktop Nav Links -->
            <ul class="nav-links">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                        Shop <i class="fa-solid fa-chevron-down"></i>
                    </a>
                    <div class="nav-dropdown">
                        <a href="{{ route('products.index') }}">All Products</a>
                        <a href="{{ route('products.index', ['category' => 'cakes']) }}">Cakes</a>
                        <a href="{{ route('products.index', ['category' => 'pastries']) }}">Pastries</a>
                        <a href="{{ route('products.index', ['category' => 'cupcakes']) }}">Cupcakes</a>
                        <a href="{{ route('products.index', ['category' => 'desserts']) }}">Desserts</a>
                        <a href="{{ route('products.index', ['category' => 'macarons']) }}">Macarons</a>
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

            <!-- Nav Icons -->
            <div class="nav-icons">
                <a href="{{ route('home') }}" class="nav-icon-btn" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <a href="https://wa.me/919895588988" target="_blank" class="nav-whatsapp-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>Order Now</span>
                </a>
                <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <a href="{{ route('home') }}" class="logo" style="border:none;padding:0;">
                <span class="logo-name" style="font-size:24px;">Cake Atelier</span>
            </a>
            <button class="mobile-close" id="closeNavBtn"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('products.index') }}">Shop</a>
        <a href="{{ route('customized') }}">Customized Cakes</a>
        <a href="{{ route('delivery') }}">Delivery</a>
        <a href="{{ route('contact') }}">Contact Us</a>
        <div style="margin-top:24px;">
            <a href="https://wa.me/919895588988" target="_blank" class="btn-teal" style="display:inline-flex;">
                <i class="fa-brands fa-whatsapp"></i> Order on WhatsApp
            </a>
        </div>
    </div>

    <!-- ===== PAGE CONTENT ===== -->
    @yield('content')

    <!-- ===== FOOTER ===== -->
    <footer>
        <div class="footer-inner">
            <!-- Brand -->
            <div class="footer-brand">
                <div class="logo">
                    <span class="logo-name" style="color:white;font-size:34px;">Cake Atelier</span>
                    <span class="logo-sub" style="color:rgba(255,255,255,0.55);">Cakes &bull; Pastries &bull; Desserts</span>
                </div>
                <p>Handcrafted premium cakes and pastries made with the finest ingredients. Your happiness is baked into every bite.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Shop</a></li>
                    <li><a href="{{ route('customized') }}">Customized Cakes</a></li>
                    <li><a href="{{ route('delivery') }}">Delivery Info</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h4>Get In Touch</h4>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>123 Baker's Lane, MG Road<br>Kochi, Kerala – 682001</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>
                        <a href="tel:+914842767660">0484 2767660</a><br>
                        <a href="tel:+919895588988">+91 98955 88988</a>
                    </span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span><a href="mailto:hello@cakeatelier.in">hello@cakeatelier.in</a></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-regular fa-clock"></i>
                    <span>Open Daily: 10 AM – 10 PM</span>
                </div>
            </div>

            <!-- Order CTA -->
            <div class="footer-col">
                <h4>Order Now</h4>
                <p style="font-size:14px;color:rgba(255,255,255,0.75);line-height:1.8;margin-bottom:20px;">
                    Place your order instantly via WhatsApp or call us for any queries about custom cakes.
                </p>
                <a href="https://wa.me/919895588988" target="_blank" class="btn-dark" style="background:white;color:var(--teal);border-color:white;font-size:13px;padding:11px 22px;">
                    <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} Cake Atelier. All rights reserved.
        </div>
    </footer>

    <script>
        document.getElementById('hamburgerBtn').addEventListener('click', function() {
            document.getElementById('mobileNav').classList.add('open');
        });
        document.getElementById('closeNavBtn').addEventListener('click', function() {
            document.getElementById('mobileNav').classList.remove('open');
        });
    </script>

    @stack('scripts')
</body>
</html>
