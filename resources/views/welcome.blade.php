@extends('layouts.app')

@section('title', 'Cake Atelier | Premium Custom Cakes & Pastries')
@section('meta_description', 'Premium handcrafted cakes, pastries and desserts. Order online for delivery or pickup. Customized cakes for weddings, birthdays and all occasions.')

@push('styles')
<style>
/* ===== HERO SECTION ===== */
.hero {
    background: var(--maroon);
    position: relative;
    min-height: 520px;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(189,150,46,0.12) 0%, transparent 70%);
}
.hero-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 60px 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
    position: relative;
    z-index: 2;
    width: 100%;
}
.hero-text h1 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(30px, 5vw, 56px);
    font-weight: 700;
    color: white;
    line-height: 1.15;
    margin-bottom: 20px;
}
.hero-text h1 span { color: var(--gold); }
.hero-text p {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
    line-height: 1.75;
    margin-bottom: 32px;
    max-width: 440px;
}
.hero-cta { display: flex; gap: 16px; flex-wrap: wrap; }
.hero-image-wrap {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}
.hero-circle-bg {
    width: 420px;
    height: 420px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    border: 2px solid rgba(255,255,255,0.12);
    position: absolute;
}
.hero-image {
    width: 360px;
    height: 360px;
    border-radius: 50%;
    object-fit: cover;
    position: relative;
    z-index: 2;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    border: 6px solid rgba(255,255,255,0.15);
}
/* Decorative floating elements */
.hero-deco {
    position: absolute;
    border-radius: 50%;
    background: var(--gold);
    opacity: 0.2;
    animation: float 5s ease-in-out infinite;
}
.hero-deco-1 { width: 80px; height: 80px; top: 10%; right: 5%; animation-delay: 0s; }
.hero-deco-2 { width: 50px; height: 50px; bottom: 20%; left: 5%; animation-delay: 1.5s; }
.hero-deco-3 { width: 30px; height: 30px; top: 50%; right: 20%; animation-delay: 3s; }
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-16px); }
}

/* ===== DRIP SEPARATOR ===== */
.drip-down {
    background: var(--maroon);
    line-height: 0;
    position: relative;
    z-index: 1;
}
.drip-down svg { width: 100%; height: 70px; display: block; }

/* ===== ABOUT SECTION ===== */
.about-section {
    background: var(--cream);
    padding: 80px 0;
}
.about-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;
}
.about-text h2 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(24px, 3.5vw, 36px);
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.3;
    margin-bottom: 8px;
}
.about-text h2 span { color: var(--maroon); }
.about-text p {
    font-size: 15px;
    line-height: 1.85;
    color: var(--text-mid);
    margin-bottom: 16px;
}
.about-image-wrap {
    position: relative;
    display: flex;
    justify-content: center;
}
.about-image {
    width: 360px;
    height: 360px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 20px 50px rgba(101,6,50,0.18);
    border: 8px solid var(--cream-dark);
}
.about-image-badge {
    position: absolute;
    bottom: 20px;
    right: 20px;
    background: var(--maroon);
    color: white;
    font-family: 'Signika', sans-serif;
    font-size: 13px;
    font-weight: 600;
    padding: 10px 20px;
    border-radius: 50px;
    box-shadow: 0 8px 20px rgba(101,6,50,0.35);
}

/* ===== PRODUCTS SECTION ===== */
.products-section {
    background: var(--maroon);
    padding: 80px 0;
    position: relative;
}
.products-section .section-title { color: white; }
.products-section .section-subtitle { color: rgba(255,255,255,0.7); }
.products-section .section-underline { background: var(--gold); }

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 28px;
    margin-top: 40px;
}

.products-cta { text-align: center; margin-top: 48px; }

/* ===== WHY US SECTION ===== */
.why-section {
    background: var(--cream);
    padding: 80px 0;
}
.why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 48px;
    align-items: center;
    max-width: 1280px;
    margin: 48px auto 0;
    padding: 0 24px;
}
.why-list { display: flex; flex-direction: column; gap: 28px; }
.why-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
}
.why-number {
    background: var(--maroon);
    color: white;
    font-family: 'Signika', sans-serif;
    font-weight: 700;
    font-size: 14px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.why-item h4 {
    font-family: 'Signika', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}
.why-item p { font-size: 13px; color: var(--text-mid); line-height: 1.7; }

.why-center-img {
    display: flex;
    justify-content: center;
    position: relative;
}
.why-center-img img {
    width: 280px;
    height: 280px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 20px 50px rgba(101,6,50,0.2);
}
/* Decorative ring */
.why-center-img::before {
    content: '';
    position: absolute;
    width: 310px;
    height: 310px;
    border-radius: 50%;
    border: 3px dashed var(--gold);
    opacity: 0.4;
    animation: spin-slow 20s linear infinite;
}
@keyframes spin-slow { 100% { transform: rotate(360deg); } }

/* ===== ORDER CTA SECTION ===== */
.order-cta-section {
    background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-dark) 100%);
    padding: 80px 24px;
    text-align: center;
}
.order-cta-section h2 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 700;
    color: white;
    margin-bottom: 16px;
}
.order-cta-section p {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
    max-width: 560px;
    margin: 0 auto 36px;
    line-height: 1.7;
}

/* ===== ANNOUNCEMENTS / AD BANNER ===== */
.ad-banner-section {
    background: var(--cream);
    padding: 60px 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .hero-inner { grid-template-columns: 1fr; text-align: center; }
    .hero-image-wrap { display: none; }
    .hero-text p { max-width: 100%; }
    .hero-cta { justify-content: center; }
    .about-inner { grid-template-columns: 1fr; }
    .about-image-wrap { display: none; }
    .why-grid { grid-template-columns: 1fr; }
    .why-center-img { display: none; }
    .why-right, .why-left { }
}
@media (max-width: 600px) {
    .products-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
}
</style>
@endpush

@section('content')

<!-- ===== HERO SECTION ===== -->
<section class="hero">
    <div class="hero-deco hero-deco-1"></div>
    <div class="hero-deco hero-deco-2"></div>
    <div class="hero-deco hero-deco-3"></div>
    <div class="hero-inner">
        <div class="hero-text">
            <h1>A team of expert bakers<br><span>ready to serve</span></h1>
            <p>We have roped in some of the best talents in the baking arena to give an artistic touch to our unique and delicious recipes.</p>
            <div class="hero-cta">
                <a href="{{ route('products.index') }}" class="btn-gold">View Our Products</a>
                <a href="{{ route('customized') }}" class="btn-maroon">Order Custom Cake</a>
            </div>
        </div>
        <div class="hero-image-wrap">
            <div class="hero-circle-bg"></div>
            <img
                src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600&auto=format&fit=crop"
                alt="Premium Cakes"
                class="hero-image"
            >
        </div>
    </div>
</section>

<!-- Chocolate drip from hero into cream -->
<div class="drip-down">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 L0,30
            Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38
            Q350,65 390,35 Q430,5 470,35 Q510,65 550,38
            Q590,10 630,38 Q670,66 710,38 Q750,10 790,35
            Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38
            Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35
            Q1310,60 1350,38 Q1390,15 1440,35
            L1440,0 Z"
            fill="var(--cream)"/>
    </svg>
</div>

<!-- ===== ABOUT SECTION ===== -->
<section class="about-section">
    <div class="about-inner">
        <div class="about-text">
            <h2>The fascinating story of the most loved<br><span>bakery brand in Kerala</span></h2>
            <div class="section-underline" style="margin:16px 0 24px;"></div>
            <p>
                Cake Atelier is the outcome of some visionary entrepreneurs stepping into the baking industry with a promising venture. Since the launch date back to five years, we have disrupted the way people buy bakery products. From introducing the modern baking culture of live cake making for customers with quality raw materials imported from foreign countries to offering premium and delicious products at our bakeries, we have achieved tremendous success owing to a great deal of passion and determination.
            </p>
            <p>
                We gave no compromise on the value of quality since the beginning with quality appliances, premium imported raw materials, hygiene confectionaries, expert bakers and staff, and internationally inspired unique recipes, all for achieving the mission and setting on a journey for a splendid vision. Our partners travelled around the globe to understand the quality of food cultures and recipes to bring such quality to our customers.
            </p>
        </div>
        <div class="about-image-wrap">
            <img
                src="https://images.unsplash.com/photo-1607478900766-efe13248b125?q=80&w=600&auto=format&fit=crop"
                alt="About our bakery"
                class="about-image"
            >
            <div class="about-image-badge">🎂 Premium Bakery</div>
        </div>
    </div>
</section>

<!-- Drip into products (cream to maroon) -->
<div style="background:var(--cream);line-height:0;">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:70px;display:block;transform:scaleY(-1);">
        <path d="M0,0 L0,30
            Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38
            Q350,65 390,35 Q430,5 470,35 Q510,65 550,38
            Q590,10 630,38 Q670,66 710,38 Q750,10 790,35
            Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38
            Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35
            Q1310,60 1350,38 Q1390,15 1440,35
            L1440,0 Z"
            fill="var(--maroon)"/>
    </svg>
</div>

<!-- ===== OUR SIGNATURE PRODUCTS ===== -->
<section class="products-section">
    <div class="container">
        <p class="section-title">Our Signature Products</p>
        <div class="section-underline"></div>
        <p class="section-subtitle">
            Our products exceed the expectation to satisfy the cravings of your sweet taste buds with exceptional baking quality, premium raw materials, expert chefs, and internationally inspired unique recipes.
        </p>

        <div class="products-grid">
            @php
                $featuredProducts = [
                    [
                        'name'  => 'Chaat Delicacies',
                        'desc'  => 'A unique fusion of Indian street flavours',
                        'price' => '₹199',
                        'img'   => 'https://images.unsplash.com/photo-1606491048802-8342506d6471?q=80&w=500&auto=format&fit=crop',
                    ],
                    [
                        'name'  => 'Tarts',
                        'desc'  => 'Buttery shells with luscious fillings',
                        'price' => '₹249',
                        'img'   => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=500&auto=format&fit=crop',
                    ],
                    [
                        'name'  => 'Cheese Cream Cakes',
                        'desc'  => 'Rich, velvety cream cheese perfection',
                        'price' => '₹549',
                        'img'   => 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500&auto=format&fit=crop',
                    ],
                    [
                        'name'  => 'French Macarons',
                        'desc'  => 'Delicate shells with flavoured ganache',
                        'price' => '₹349',
                        'img'   => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=500&auto=format&fit=crop',
                    ],
                    [
                        'name'  => 'Premium Pastries',
                        'desc'  => 'Flaky, golden baked layered pastries',
                        'price' => '₹179',
                        'img'   => 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=500&auto=format&fit=crop',
                    ],
                    [
                        'name'  => 'Triffles',
                        'desc'  => 'Layered desserts with cream & fruit',
                        'price' => '₹299',
                        'img'   => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=500&auto=format&fit=crop',
                    ],
                ];
            @endphp

            @if(isset($products) && $products->count())
                @foreach($products as $product)
                <a href="#" class="product-card">
                    <img src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500' }}"
                         alt="{{ $product->name }}">
                    <div class="product-card-body">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ Str::limit($product->description, 55) }}</p>
                        <div class="price" style="margin-top:8px;">₹{{ number_format($product->base_price, 2) }}</div>
                    </div>
                </a>
                @endforeach
            @else
                @foreach($featuredProducts as $p)
                <a href="{{ route('products.index') }}" class="product-card">
                    <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}">
                    <div class="product-card-body">
                        <h3>{{ $p['name'] }}</h3>
                        <p>{{ $p['desc'] }}</p>
                        <div class="price" style="margin-top:8px;">{{ $p['price'] }}</div>
                    </div>
                </a>
                @endforeach
            @endif
        </div>

        <div class="products-cta">
            <a href="{{ route('products.index') }}" class="btn-gold">View All Products</a>
        </div>
    </div>
</section>

<!-- Drip from maroon products section back to cream -->
<div style="background:var(--maroon);line-height:0;">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:70px;display:block;">
        <path d="M0,0 L0,30
            Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38
            Q350,65 390,35 Q430,5 470,35 Q510,65 550,38
            Q590,10 630,38 Q670,66 710,38 Q750,10 790,35
            Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38
            Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35
            Q1310,60 1350,38 Q1390,15 1440,35
            L1440,0 Z"
            fill="var(--cream)"/>
    </svg>
</div>

<!-- ===== WHY OUR PRODUCTS ARE THE BEST ===== -->
<section class="why-section">
    <div class="container">
        <p class="section-title">Why our products are the best?</p>
        <div class="section-underline"></div>
        <p class="section-subtitle">
            Cake Atelier offers a wide range of tasty bakery products at affordable pricing. Our products are made from quality raw materials with exceptional baking quality.
        </p>
    </div>

    <div class="why-grid">
        <!-- Left Column -->
        <div class="why-list">
            <div class="why-item">
                <div class="why-number">01</div>
                <div>
                    <h4>Modern baking culture</h4>
                    <p>Cake Atelier is one of the finest bakers in Kerala and the first to introduce modern baking methods, including live cake making.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-number">02</div>
                <div>
                    <h4>Healthy and hygienic</h4>
                    <p>At Cake Atelier, we give no compromise on maintaining a healthy and hygienic atmosphere for baking our products.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-number">03</div>
                <div>
                    <h4>Internationally inspired recipes</h4>
                    <p>Our partners travelled to many countries to experience the quality of international recipes to bring home the inspiration.</p>
                </div>
            </div>
        </div>

        <!-- Centre Image -->
        <div class="why-center-img">
            <img
                src="https://images.unsplash.com/photo-1541599188778-cdc73298f7b2?q=80&w=600&auto=format&fit=crop"
                alt="Our premium baking"
            >
        </div>

        <!-- Right Column -->
        <div class="why-list">
            <div class="why-item" style="text-align:right;flex-direction:row-reverse;">
                <div class="why-number">04</div>
                <div>
                    <h4>Quality appliances</h4>
                    <p>We use the latest and finest machinery and appliances to bake quality and delicious products for our customers.</p>
                </div>
            </div>
            <div class="why-item" style="text-align:right;flex-direction:row-reverse;">
                <div class="why-number">05</div>
                <div>
                    <h4>Finest raw materials</h4>
                    <p>We use only the finest and purest raw materials imported from foreign countries to bake the best quality bakeries.</p>
                </div>
            </div>
            <div class="why-item" style="text-align:right;flex-direction:row-reverse;">
                <div class="why-number">06</div>
                <div>
                    <h4>Affordable pricing</h4>
                    <p>Even with all the specialities and expensive raw materials, we sell our products at affordable pricing for our customers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== ORDER CTA ===== -->
<section class="order-cta-section">
    <h2>Ready to Order Your Dream Cake?</h2>
    <p>Place your order now via WhatsApp or browse our full product catalogue. We deliver fresh to your door!</p>
    <a href="https://wa.me/919895588988" target="_blank" class="btn-gold" style="font-size:15px;padding:14px 40px;">
        <i class="fa-brands fa-whatsapp"></i>&nbsp; ORDER NOW
    </a>
</section>

<!-- ===== ADVERTISEMENT BANNERS ===== -->
@if(isset($advertisements) && $advertisements->count())
<section class="ad-banner-section">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;">
            @foreach($advertisements as $ad)
            <div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(101,6,50,0.12);">
                <img src="{{ Storage::url($ad->image) }}" alt="{{ $ad->title }}" style="width:100%;height:200px;object-fit:cover;">
                @if($ad->title)
                <div style="background:var(--maroon);color:white;padding:12px 16px;font-family:'Signika',sans-serif;font-weight:600;">
                    {{ $ad->title }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
