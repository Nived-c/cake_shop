<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'L\'Atelier | Artisanal Cakes')</title>
    <meta name="description" content="@yield('meta_description', 'Premium luxury cakes and artisanal pastries.')">

    <!-- Luxury Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* ===== LUXURY THEME TOKENS ===== */
        :root {
            --color-bg: #050505;
            --color-bg-light: #151515;
            --color-text: #F5F0E6;
            --color-text-dim: rgba(245, 240, 230, 0.6);
            --color-accent: #B2915F; /* Muted Gold */
            
            --font-serif: 'Cormorant Garamond', serif;
            --font-display: 'Cinzel', serif;
            --font-script: 'Great Vibes', cursive;
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: var(--font-serif);
            background-color: var(--color-bg);
            color: var(--color-text);
            min-height: 100vh;
            line-height: 1.6;
            font-size: 18px;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; transition: color 0.3s; }
        a:hover { color: var(--color-accent); }
        img { display: block; max-width: 100%; height: auto; }

        /* ===== GLOBAL REVEAL / SLIDE ANIMATION ===== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1.2s cubic-bezier(0.215, 0.610, 0.355, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .fade-in {
            opacity: 0;
            transition: opacity 1.5s ease;
        }
        .fade-in.active { opacity: 1; }

        /* ===== BUTTONS ===== */
        .btn-outline {
            display: inline-block;
            border: 1px solid var(--color-accent);
            color: var(--color-text);
            font-family: var(--font-display);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.8rem;
            padding: 15px 40px;
            backdrop-filter: blur(5px);
            background: rgba(0,0,0,0.2);
            transition: all 0.4s ease;
            cursor: pointer;
        }
        .btn-outline:hover {
            background: var(--color-accent);
            color: #000;
        }

        .btn-solid {
            display: inline-block;
            background: var(--color-accent);
            color: #000;
            font-family: var(--font-display);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.8rem;
            padding: 15px 40px;
            transition: all 0.4s ease;
            cursor: pointer;
            border: 1px solid var(--color-accent);
        }
        .btn-solid:hover {
            background: transparent;
            color: var(--color-text);
        }

        /* ===== TOP ANNOUNCEMENT BAR ===== */
        .top-bar {
            background: var(--color-bg-light);
            color: var(--color-text-dim);
            text-align: center;
            padding: 10px 16px;
            font-size: 0.75rem;
            font-family: var(--font-display);
            letter-spacing: 0.15em;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* ===== HEADER / NAVBAR ===== */
        header {
            background: rgba(5, 5, 5, 0.9);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            height: 90px;
        }

        .logo-box {
            font-family: var(--font-display);
            font-size: 1.5rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--color-text);
            display: flex;
            flex-direction: column;
        }
        .logo-box span { font-size: 0.6rem; letter-spacing: 0.4em; color: var(--color-accent); margin-top: 4px; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 40px;
            list-style: none;
        }
        .nav-links a {
            font-family: var(--font-display);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--color-text-dim);
            transition: color 0.3s;
            position: relative;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--color-accent); }
        
        .hamburger {
            display: none;
            background: none; border: none;
            color: var(--color-text); font-size: 24px; cursor: pointer;
        }

        /* ===== DROPDOWN ===== */
        .dropdown { position: relative; }
        .dropdown-menu {
            position: absolute; top: 100%; left: 0;
            background: var(--color-bg-light);
            min-width: 200px;
            border: 1px solid rgba(255,255,255,0.1);
            opacity: 0; visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s;
            padding: 10px 0;
        }
        .dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-menu a {
            display: block; padding: 12px 20px;
            font-family: var(--font-serif);
            text-transform: none; font-size: 1.1rem; letter-spacing: 0;
        }

        /* ===== COMPONENT HELPERS FOR OTHER PAGES ===== */
        .page-header {
            padding: 120px 20px 80px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
            position: relative;
        }
        .page-header::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to bottom, rgba(5,5,5,0.8), var(--color-bg));
        }
        .page-header-inner { position: relative; z-index: 2; }
        
        .section-title-cursive {
            font-family: var(--font-script);
            font-size: clamp(60px, 10vw, 120px);
            line-height: 0.8;
            color: var(--color-accent);
            margin-bottom: 20px;
            font-weight: normal;
        }
        
        .section-subtitle-serif {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--color-text-dim);
        }

        /* Redesigning standard tables or forms for dark mode if they exist */
        input, select, textarea {
            background: var(--color-bg-light); border: 1px solid rgba(255,255,255,0.1);
            color: var(--color-text); font-family: var(--font-serif); padding: 15px; width: 100%; outline: none;
            transition: border-color 0.3s;
        }
        input:focus, select:focus, textarea:focus { border-color: var(--color-accent); }
        
        /* Fix select options for dark theme */
        select option {
            background-color: var(--color-bg-light) !important;
            color: var(--color-text) !important;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--color-bg-light);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 80px 0 0;
            margin-top: 100px;
        }
        .footer-grid {
            display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 60px;
            max-width: 1400px; margin: 0 auto; padding: 0 40px 60px;
        }
        .footer-logo { font-family: var(--font-display); font-size: 1.5rem; letter-spacing: 0.2em; color: var(--color-text); margin-bottom: 20px; }
        .footer-p { color: var(--color-text-dim); font-size: 1rem; line-height: 1.8; margin-bottom: 30px; }
        
        .footer-title {
            font-family: var(--font-display);
            font-size: 0.8rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--color-accent); margin-bottom: 30px;
        }
        
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: var(--color-text-dim); font-size: 1.1rem; }
        
        .footer-bottom {
            text-align: center; padding: 25px;
            border-top: 1px solid rgba(255,255,255,0.05);
            font-family: var(--font-display); font-size: 0.7rem; letter-spacing: 0.2em;
            color: rgba(255,255,255,0.3);
        }

        @media (max-width: 900px) {
            .nav-links { display: none; }
            .hamburger { display: block; }
            .footer-grid { grid-template-columns: 1fr; gap: 40px; }
        }
    </style>

    @stack('styles')
</head>
<body>
    
    <!-- Top Announcement Bar -->
    <div class="top-bar reveal">
        FREE DELIVERY FOR WEDDINGS & GALAS &nbsp;—&nbsp; CONTACT: 000000
    </div>

    <!-- Header / Navbar -->
    <header class="reveal">
        <div class="nav-inner">
            <a href="{{ route('home') }}" class="logo-box">
                L'Atelier
                <span>Confections</span>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">The Atelier</a></li>
                <li class="dropdown">
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Cakes</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('products.index') }}">Full Catalog</a>
                        <a href="{{ route('products.index', ['category' => 'cakes']) }}">Signature Cakes</a>
                        <a href="{{ route('products.index', ['category' => 'pastries']) }}">Artisanal Pastries</a>
                    </div>
                </li>
                <li><a href="{{ route('customized') }}" class="{{ request()->routeIs('customized') ? 'active' : '' }}">Custom Cakes Orders</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Connect</a></li>
            </ul>

            <button class="hamburger"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- Page Content -->
    @yield('content')

    <!-- ===== FOOTER ===== -->
    <footer class="reveal">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">L'Atelier</div>
                <p class="footer-p">Pioneering the modern baking culture with internationally inspired recipes and the finest imported raw materials. UAE's premier artisanal bakery.</p>
                <div style="display:flex; gap:15px; color:var(--color-accent); font-size: 1.2rem;">
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
            </div>
            <div>
                <h4 class="footer-title">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">The Experience</a></li>
                    <li><a href="{{ route('products.index') }}">Cakes</a></li>
                    <li><a href="{{ route('customized') }}">Custom Cakes Design</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Client Services</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('delivery') }}">Delivery Protocol</a></li>
                    <li><a href="#">Tasting Appointments</a></li>
                    <li><a href="{{ route('contact') }}">Contact Concierge</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Reservations</h4>
                <p class="footer-p text-sm">To commission a custom piece or schedule a tasting, reach out to our team directly.</p>
                <a href="https://wa.me/000000" class="btn-outline" style="padding: 10px 20px; font-size:0.7rem;">Book via WhatsApp</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; {{ date('Y') }} L'ATELIER CONFECTIONS. ALL RIGHTS RESERVED.
        </div>
    </footer>

    <!-- Global Scroll Reveal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.15
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: stop observing once revealed
                        // observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal, .fade-in');
            revealElements.forEach(el => observer.observe(el));
            
            // Trigger immediately for items strictly in viewport on load
            setTimeout(() => {
                revealElements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if(rect.top < window.innerHeight) {
                        el.classList.add('active');
                    }
                });
            }, 100);
        });
    </script>

    @stack('scripts')
</body>
</html>
