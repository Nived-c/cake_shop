@extends('layouts.app')

@section('title', 'L\'Atelier | The artisanal experience')
@section('meta_description', 'Experience the artisanal world of Cake Atelier through our immersive culinary journey.')

@push('styles')
<style>
    /* Hide the default global header on homepage since we want an immersive start */
    header, .top-bar { display: none !important; }

    .fs-section {
        position: relative;
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    /* Fixed Navigation Overlay specifically for Home */
    .immersive-nav {
        position: fixed;
        top: 0; left: 0; width: 100%;
        padding: 40px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
        pointer-events: none;
    }
    .immersive-nav > * { pointer-events: auto; }
    
    .immersive-logo {
        font-family: var(--font-display);
        font-size: 1.2rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--color-text);
        text-decoration: none;
    }
    
    .immersive-links a {
        font-family: var(--font-display);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--color-text-dim);
        text-decoration: none;
        margin-left: 40px;
        transition: color 0.3s;
    }
    
    .immersive-links a:hover { color: var(--color-accent); }

    /* Parallax Background */
    .fs-bg {
        position: absolute;
        inset: -10%; /* bigger for parallax */
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Simple parallax effect */
        z-index: 1;
        filter: brightness(0.55) contrast(1.1) saturate(0.85);
        transition: transform 0.5s ease-out;
    }
    
    /* Radial lighting effect behind text text */
    .fs-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, transparent 30%, rgba(5,5,5,0.8) 100%),
                    linear-gradient(to bottom, rgba(5,5,5,0.4) 0%, transparent 20%, transparent 80%, rgba(5,5,5,0.8) 100%);
        z-index: 2;
    }

    .fs-content {
        position: relative;
        z-index: 3;
        text-align: center;
        width: 100%;
        max-width: 1200px;
    }

    /* Giant Script Title */
    .fs-title {
        font-family: var(--font-script);
        font-size: clamp(80px, 15vw, 240px);
        color: var(--color-text);
        line-height: 0.8;
        text-shadow: 0 10px 40px rgba(0,0,0,0.8);
        margin: 0;
        font-weight: normal;
    }

    /* Secondary Serif Title */
    .fs-subtitle {
        font-family: var(--font-serif);
        font-style: italic;
        font-size: clamp(20px, 2.5vw, 32px);
        letter-spacing: 0.05em;
        margin: 30px auto 0;
        max-width: 700px;
        text-shadow: 0 2px 20px rgba(0,0,0,0.9);
        color: rgba(245, 240, 230, 0.9);
    }

    /* Floating Metadata */
    .fs-meta {
        position: absolute;
        text-align: center;
    }

    .fs-meta .label {
        display: block;
        font-family: var(--font-display);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.3em;
        color: var(--color-text-dim);
        margin-bottom: 8px;
    }

    .fs-meta .value {
        display: block;
        font-family: var(--font-serif);
        font-size: 1.4rem;
        font-style: italic;
        color: var(--color-accent);
    }

    .meta-1 { top: 25%; left: 10%; text-align: left; }
    .meta-2 { top: 25%; right: 10%; text-align: right; }
    .meta-3 { bottom: 25%; left: 15%; text-align: left; }
    .meta-4 { bottom: 25%; right: 15%; text-align: right; }

    .fs-action { margin-top: 80px; }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        font-family: var(--font-display);
        font-size: 0.6rem;
        letter-spacing: 0.3em;
        color: var(--color-text-dim);
        text-transform: uppercase;
        animation: bob 2s infinite ease-in-out;
    }
    @keyframes bob {
        0%, 100% { transform: translate(-50%, 0); opacity: 0.5; }
        50% { transform: translate(-50%, 10px); opacity: 1; }
    }

    @media (max-width: 768px) {
        .meta-1, .meta-2, .meta-3, .meta-4 { display: none; }
        .immersive-links { display: none; }
        .fs-subtitle { font-size: 18px; padding: 0 20px; margin-top: 15px; }
        .immersive-nav { padding: 30px; }
    }
</style>
@endpush

@section('content')

<div class="immersive-nav reveal">
    <a href="{{ route('home') }}" class="immersive-logo">L'Atelier</a>
    <div class="immersive-links">
        <a href="{{ route('products.index') }}">Cakes</a>
        <a href="{{ route('customized') }}">Custom Cakes</a>
        <a href="{{ route('admin.login') }}">Admin</a>
    </div>
</div>

<!-- ROOM 1: HERO -->
<section class="fs-section">
    <div class="fs-bg" style="background-image: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop');"></div>
    <div class="fs-overlay"></div>
    
    <div class="fs-content">
        <div class="fs-meta meta-1 reveal" style="transition-delay: 0.2s">
            <span class="label">Establishment</span>
            <span class="value">Loved in UAE</span>
        </div>
        <div class="fs-meta meta-2 reveal" style="transition-delay: 0.4s">
            <span class="label">Our Method</span>
            <span class="value">Live Cake Making</span>
        </div>
        
        <h1 class="fs-title reveal">L'Atelier</h1>
        <p class="fs-subtitle reveal" style="transition-delay: 0.3s">A team of expert bakers, introducing modern artisan culture to timeless recipes.</p>

        <div class="fs-action reveal" style="transition-delay: 0.5s">
            <a href="{{ route('products.index') }}" class="btn-outline">Unlock The Collection</a>
        </div>
    </div>
    <div class="scroll-indicator">Scroll to continue</div>
</section>

<!-- ROOM 2: SIGNATURES -->
<section class="fs-section">
    <div class="fs-bg" style="background-image: url('https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=2000&auto=format&fit=crop');"></div>
    <div class="fs-overlay"></div>
    
    <div class="fs-content">
        <div class="fs-meta meta-1 reveal" style="transition-delay: 0.2s">
            <span class="label">Tarts & Pastries</span>
            <span class="value">Flaky perfection</span>
        </div>
        <div class="fs-meta meta-4 reveal" style="transition-delay: 0.4s">
            <span class="label">Cheese Cream</span>
            <span class="value">Velvety & Rich</span>
        </div>
        
        <h1 class="fs-title reveal" style="font-size: clamp(60px, 12vw, 180px);">Signatures</h1>
        <p class="fs-subtitle reveal" style="transition-delay: 0.3s">Exceeding expectations to satisfy your cravings with exceptional artisanal quality.</p>

        <div class="fs-action reveal" style="transition-delay: 0.5s">
            <a href="{{ route('products.index') }}" class="btn-outline">View Menu</a>
        </div>
    </div>
</section>

<!-- ROOM 3: BESPOKE -->
<section class="fs-section">
    <div class="fs-bg" style="background-image: url('https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=2000&auto=format&fit=crop'); filter: brightness(0.4) sepia(0.3) hue-rotate(-15deg);"></div>
    <div class="fs-overlay"></div>
    
    <div class="fs-content">
        <div class="fs-meta meta-1 reveal" style="transition-delay: 0.2s">
            <span class="label">Occasions</span>
            <span class="value">Weddings & Galas</span>
        </div>
        
        <h1 class="fs-title reveal" style="font-size: clamp(60px, 14vw, 200px);">Custom Cakes</h1>
        <p class="fs-subtitle reveal" style="transition-delay: 0.3s">Sculpted masterpieces tailored uniquely for your grand celebrations.</p>

        <div class="fs-meta meta-2 reveal" style="transition-delay: 0.4s; top:auto; bottom: -50px;">
            <span class="label">Consultation</span>
            <span class="value">By Appointment</span>
        </div>

        <div class="fs-action reveal" style="transition-delay: 0.5s">
            <a href="{{ route('customized') }}" class="btn-outline">Order Custom</a>
        </div>
    </div>
</section>

<!-- ROOM 4: THE CRAFT -->
<section class="fs-section">
    <div class="fs-bg" style="background-image: url('https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=2000&auto=format&fit=crop');"></div>
    <div class="fs-overlay"></div>
    
    <div class="fs-content">
        <div class="fs-meta meta-1 reveal" style="transition-delay: 0.2s">
            <span class="label">The Craft</span>
            <span class="value">Healthy & Hygienic</span>
        </div>
        <div class="fs-meta meta-3 reveal" style="transition-delay: 0.4s">
            <span class="label">The Tools</span>
            <span class="value">Finest Machinery</span>
        </div>
        
        <h1 class="fs-title reveal" style="font-size: clamp(70px, 14vw, 200px);">The Art</h1>
        <p class="fs-subtitle reveal" style="transition-delay: 0.3s">Our partners traveled the globe to bring home the highest quality food cultures.</p>

        <div class="fs-action reveal" style="transition-delay: 0.5s">
            <a href="https://wa.me/000000" target="_blank" class="btn-outline">Contact the Chef</a>
        </div>
    </div>
</section>

<!-- Footer is handled by layouts.app automatically at the bottom, but we'll disable it here for full immersion if we wanted to. However, standard scroll means the footer is perfectly fine at the very bottom! -->

@endsection

@push('scripts')
<script>
    // Smooth Parallax Effect on background scroll to match Fornasetti sliding glide
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        
        // Find all sections
        document.querySelectorAll('.fs-section').forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            // Optional: Shift the background slightly based on scroll position within the window
            const bg = section.querySelector('.fs-bg');
            if (bg && rect.top < window.innerHeight && rect.bottom > 0) {
                const shift = (rect.top / window.innerHeight) * 15; 
                bg.style.transform = `translateY(${shift}%) scale(1.05)`;
            }
        });
    });
</script>
@endpush
