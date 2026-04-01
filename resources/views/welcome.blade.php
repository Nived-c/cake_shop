@extends('layouts.app')
@section('title', 'Cake Atelier | Premium Custom Cakes & Pastries')
@section('meta_description', 'Premium handcrafted cakes, pastries and desserts. Order online for delivery or pickup.')

@push('styles')
<style>
/* ===== HERO SLIDER (Lollino style) ===== */
.hero {
    background: var(--light-gray);
    min-height: 540px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.hero-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 80px 32px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: center;
    width: 100%;
}
.hero-text { position: relative; z-index: 2; }
.hero-label {
    font-family: 'Jost', sans-serif;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--teal);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.hero-label::before {
    content: '';
    display: inline-block;
    width: 32px;
    height: 2px;
    background: var(--teal);
}
.hero-text h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(36px, 5vw, 66px);
    font-weight: 400;
    color: var(--dark);
    line-height: 1.15;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
}
.hero-text h1 em {
    font-style: italic;
    color: var(--teal);
}
.hero-text p {
    font-size: 16px;
    color: var(--muted);
    line-height: 1.8;
    margin-bottom: 32px;
    max-width: 420px;
}
.hero-cta { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
.hero-image-wrap {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-image {
    width: 100%;
    max-width: 480px;
    aspect-ratio: 1/1;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 24px 64px rgba(0,0,0,0.12);
}
.hero-badge {
    position: absolute;
    bottom: 40px;
    left: 0;
    background: var(--teal);
    color: white;
    font-family: 'Jost', sans-serif;
    font-size: 12px;
    font-weight: 700;
    padding: 10px 20px;
    border-radius: 4px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

/* Hero category tabs */
.hero-tabs {
    display: flex;
    align-items: center;
    gap: 0;
    margin-top: 20px;
    border-top: 1px solid var(--border);
    padding-top: 16px;
}
.hero-tab {
    font-family: 'Jost', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
    padding: 0 24px 0 0;
    cursor: pointer;
    transition: color 0.2s;
    position: relative;
}
.hero-tab:not(:first-child) { padding-left: 24px; border-left: 1px solid var(--border); }
.hero-tab:hover, .hero-tab.active { color: var(--teal); }

/* ===== WELCOME SECTION ===== */
.welcome-section { padding: 100px 0; background: var(--white); }
.welcome-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
}
.welcome-images {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.welcome-images img {
    width: 100%;
    aspect-ratio: 3/4;
    object-fit: cover;
    border-radius: 4px;
}
.welcome-images img:first-child { aspect-ratio: 1/1; grid-column: 1/-1; }

/* ===== PRODUCTS SECTION ===== */
.products-section { padding: 100px 0; background: var(--off-white); }
.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    margin-top: 48px;
}
.products-cta { text-align: center; margin-top: 56px; }

/* ===== WHY US SECTION ===== */
.why-section { padding: 100px 0; background: var(--white); }
.why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    max-width: 1280px;
    margin: 60px auto 0;
    padding: 0 32px;
}
.why-list { display: flex; flex-direction: column; gap: 32px; }
.why-item { display: flex; gap: 20px; align-items: flex-start; }
.why-item-num {
    font-family: 'Playfair Display', serif;
    font-size: 40px;
    font-weight: 400;
    color: var(--light-gray);
    line-height: 1;
    flex-shrink: 0;
    width: 48px;
    text-align: center;
}
.why-item h4 {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 500;
    color: var(--dark);
    margin-bottom: 6px;
}
.why-item p { font-size: 14px; color: var(--muted); line-height: 1.75; }
.why-image img {
    width: 100%;
    aspect-ratio: 4/5;
    object-fit: cover;
    border-radius: 4px;
}

/* ===== CTA BANNER ===== */
.cta-banner {
    background: var(--teal);
    padding: 80px 32px;
    text-align: center;
}
.cta-banner h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 4vw, 48px);
    font-weight: 400;
    color: white;
    margin-bottom: 16px;
}
.cta-banner p {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
    margin-bottom: 36px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.7;
}

/* Responsive */
@media (max-width: 1024px) {
    .products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 860px) {
    .hero-inner { grid-template-columns: 1fr; }
    .hero-image-wrap { display: none; }
    .welcome-inner { grid-template-columns: 1fr; }
    .welcome-images { display: none; }
    .why-grid { grid-template-columns: 1fr; }
    .why-image { display: none; }
    .products-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 500px) {
    .products-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
</style>
@endpush

@section('content')

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-text">
            <div class="hero-label">Premium Bakery</div>
            <h1>A team of <em>expert bakers</em> ready to serve</h1>
            <p>We have roped in some of the best talents in the baking arena to give an artistic touch to our unique and delicious recipes.</p>
            <div class="hero-cta">
                <a href="{{ route('products.index') }}" class="btn-teal">
                    <i class="fa-solid fa-crown"></i> Shop All Products
                </a>
                <a href="{{ route('customized') }}" class="btn-outline">
                    Order Custom Cake
                </a>
            </div>
            <div class="hero-tabs">
                <div class="hero-tab active">Premium</div>
                <div class="hero-tab">Special</div>
                <div class="hero-tab">Best of the Best</div>
            </div>
        </div>
        <div class="hero-image-wrap">
            <img
                src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=700&auto=format&fit=crop"
                alt="Premium Cake"
                class="hero-image"
            >
            <div class="hero-badge">🏆 Award Winning</div>
        </div>
    </div>
</section>

<!-- ===== WELCOME / ABOUT ===== -->
<section class="welcome-section">
    <div class="welcome-inner">
        <div class="welcome-images">
            <img src="https://images.unsplash.com/photo-1607478900766-efe13248b125?q=80&w=600&auto=format&fit=crop" alt="Our bakery">
            <img src="https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=400&auto=format&fit=crop" alt="Cakes">
            <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=400&auto=format&fit=crop" alt="Pastries">
        </div>
        <div>
            <span class="section-label">Welcome to Cake Atelier</span>
            <h2 class="section-heading">The fascinating story of the most loved <em style="font-style:italic;color:var(--teal);">bakery in Kerala</em></h2>
            <div class="teal-divider"></div>
            <p class="section-text" style="max-width:100%;margin-bottom:16px;">
                Cake Atelier is the outcome of some visionary entrepreneurs stepping into the baking industry with a promising venture. Since the launch date back to five years, we have disrupted the way people buy bakery products.
            </p>
            <p class="section-text" style="max-width:100%;margin-bottom:32px;">
                From introducing the modern baking culture of live cake making for customers with quality raw materials imported from foreign countries to offering premium and unique products at our bakeries, we have achieved tremendous success owing to a great deal of passion and determination.
            </p>
            <a href="{{ route('products.index') }}" class="btn-teal">Explore Our Products</a>
        </div>
    </div>
</section>

<!-- ===== SIGNATURE PRODUCTS ===== -->
<section class="products-section">
    <div class="container">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;">
            <div>
                <span class="section-label">Our Bestsellers</span>
                <h2 class="section-heading" style="margin-bottom:0;">Our Signature Products</h2>
            </div>
            <a href="{{ route('products.index') }}" class="btn-outline">View All &rarr;</a>
        </div>

        <div class="products-grid">
            @php
                $featuredProducts = [
                    ['name'=>'Chaat Delicacies','cat'=>'SPECIAL','price'=>'₹199','badge'=>null,'img'=>'https://images.unsplash.com/photo-1606491048802-8342506d6471?q=80&w=600'],
                    ['name'=>'Classic Tarts','cat'=>'PREMIUM','price'=>'₹249','badge'=>'Popular','img'=>'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=600'],
                    ['name'=>'Cheese Cream Cake','cat'=>'PREMIUM','price'=>'₹549','badge'=>'Bestseller','img'=>'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600'],
                    ['name'=>'French Macarons','cat'=>'SPECIAL','price'=>'₹349','badge'=>null,'img'=>'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=600'],
                    ['name'=>'Butter Pastries','cat'=>'DAILY','price'=>'₹179','badge'=>null,'img'=>'https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=600'],
                    ['name'=>'Strawberry Triffle','cat'=>'SPECIAL','price'=>'₹299','badge'=>'New','img'=>'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=600'],
                    ['name'=>'Red Velvet Cake','cat'=>'PREMIUM','price'=>'₹599','badge'=>null,'img'=>'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?q=80&w=600'],
                    ['name'=>'Baked Cheesecake','cat'=>'PREMIUM','price'=>'₹699','badge'=>null,'img'=>'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=600'],
                ];
            @endphp

            @if(isset($products) && $products->count())
                @foreach($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="product-card">
                    <div class="product-card-img">
                        <img src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600' }}" alt="{{ $product->name }}">
                    </div>
                    @if($product->category)<div class="product-card-cat">{{ $product->category->name }}</div>@endif
                    <div class="product-card-name">{{ $product->name }}</div>
                    <div class="product-card-price">₹{{ number_format($product->base_price, 2) }}</div>
                </a>
                @endforeach
            @else
                @foreach($featuredProducts as $p)
                <a href="{{ route('products.index') }}" class="product-card">
                    <div class="product-card-img">
                        @if($p['badge'])<div class="product-card-badge">{{ $p['badge'] }}</div>@endif
                        <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy">
                    </div>
                    <div class="product-card-cat">{{ $p['cat'] }}</div>
                    <div class="product-card-name">{{ $p['name'] }}</div>
                    <div class="product-card-price">{{ $p['price'] }}</div>
                </a>
                @endforeach
            @endif
        </div>

        <div class="products-cta">
            <a href="{{ route('products.index') }}" class="btn-teal">
                <i class="fa-solid fa-crown"></i> View All Products
            </a>
        </div>
    </div>
</section>

<!-- ===== WHY US ===== -->
<section class="why-section">
    <div class="container">
        <span class="section-label">Why Choose Us</span>
        <h2 class="section-heading">Why our products are the best?</h2>
        <div class="teal-divider"></div>
        <p class="section-text">Cake Atelier offers a wide range of tasty bakery products at affordable pricing. Our products are made from quality raw materials with exceptional baking quality.</p>
    </div>
    <div class="why-grid">
        <div class="why-list">
            <div class="why-item">
                <div class="why-item-num">01</div>
                <div>
                    <h4>Modern baking culture</h4>
                    <p>Cake Atelier is one of the finest bakers in Kerala and the first to introduce modern baking methods, including live cake making.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-item-num">02</div>
                <div>
                    <h4>Healthy and hygienic</h4>
                    <p>At Cake Atelier, we give no compromise on maintaining a healthy and hygienic atmosphere for baking our products.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-item-num">03</div>
                <div>
                    <h4>Internationally inspired recipes</h4>
                    <p>Our partners travelled to many countries to experience the quality of international recipes to bring home the inspiration.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-item-num">04</div>
                <div>
                    <h4>Quality appliances & finest materials</h4>
                    <p>We use the latest machinery and only the finest raw materials imported from foreign countries to bake the best quality products.</p>
                </div>
            </div>
            <div class="why-item">
                <div class="why-item-num">05</div>
                <div>
                    <h4>Affordable pricing</h4>
                    <p>Even with all the specialities and expensive raw materials, we sell our products at affordable pricing for our customers.</p>
                </div>
            </div>
        </div>
        <div class="why-image">
            <img src="https://images.unsplash.com/photo-1541599188778-cdc73298f7b2?q=80&w=700&auto=format&fit=crop" alt="Our bakery team">
        </div>
    </div>
</section>

<!-- ===== ORDER CTA ===== -->
<section class="cta-banner">
    <h2>Ready to Order Your Dream Cake?</h2>
    <p>Place your order now via WhatsApp or browse our full product catalogue. We deliver fresh to your door!</p>
    <a href="https://wa.me/919895588988" target="_blank" class="btn-dark" style="background:white;color:var(--teal);border-color:white;font-size:15px;padding:14px 40px;">
        <i class="fa-brands fa-whatsapp"></i> ORDER NOW
    </a>
</section>

<!-- ===== AD BANNERS ===== -->
@if(isset($advertisements) && $advertisements->count())
<section style="padding:80px 0;background:var(--off-white);">
    <div class="container">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">
            @foreach($advertisements as $ad)
            <div style="background:var(--white);border-radius:4px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                <img src="{{ Storage::url($ad->image) }}" alt="{{ $ad->title }}" style="width:100%;height:220px;object-fit:cover;">
                @if($ad->title)
                <div style="padding:14px 16px;font-family:'Playfair Display',serif;font-size:16px;color:var(--dark);">{{ $ad->title }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
