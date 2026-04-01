@extends('layouts.app')

@section('title', 'Products | Cake Atelier')
@section('meta_description', 'Browse all our premium cakes, pastries, macarons and desserts. Filter by category and order online.')

@push('styles')
<style>
/* ===== PAGE HERO ===== */
.page-hero {
    background: var(--maroon);
    padding: 60px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.page-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at center, rgba(189,150,46,0.1) 0%, transparent 70%);
}
.page-hero h1 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(30px, 5vw, 52px);
    font-weight: 700;
    color: white;
    position: relative;
    z-index: 2;
    margin-bottom: 10px;
}
.page-hero p {
    color: rgba(255,255,255,0.75);
    font-size: 16px;
    position: relative;
    z-index: 2;
}
.breadcrumb {
    position: relative;
    z-index: 2;
    font-size: 13px;
    color: rgba(255,255,255,0.6);
    margin-bottom: 16px;
}
.breadcrumb a { color: var(--gold); }
.breadcrumb a:hover { text-decoration: underline; }

/* ===== DRIP ===== */
.drip-down { background:var(--maroon); line-height:0; }
.drip-down svg { width:100%; height:70px; display:block; }

/* ===== PRODUCTS LAYOUT ===== */
.products-page { background: var(--cream); min-height: 60vh; }
.products-page-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 56px 24px 80px;
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 40px;
    align-items: start;
}

/* ===== SIDEBAR ===== */
.sidebar {
    position: sticky;
    top: calc(var(--nav-height) + 20px);
}
.sidebar-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(101,6,50,0.08);
    margin-bottom: 24px;
}
.sidebar-card h3 {
    font-family: 'Signika', sans-serif;
    font-size: 17px;
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--cream-dark);
}
.category-filter-list { list-style: none; }
.category-filter-list li a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 9px 12px;
    border-radius: 6px;
    font-size: 14px;
    color: var(--text-mid);
    transition: all 0.2s;
    font-weight: 500;
}
.category-filter-list li a:hover,
.category-filter-list li a.active {
    background: var(--maroon);
    color: white;
}
.category-filter-list li a .count {
    background: rgba(101,6,50,0.1);
    color: var(--maroon);
    border-radius: 20px;
    padding: 2px 9px;
    font-size: 11px;
    font-weight: 700;
}
.category-filter-list li a.active .count { background: rgba(255,255,255,0.2); color: white; }

/* Search/filter box */
.filter-search {
    display: flex;
    align-items: center;
    background: var(--cream);
    border: 2px solid var(--cream-dark);
    border-radius: 8px;
    overflow: hidden;
    transition: border-color 0.2s;
}
.filter-search:focus-within { border-color: var(--maroon); }
.filter-search input {
    flex: 1;
    padding: 10px 12px;
    border: none;
    outline: none;
    background: transparent;
    font-size: 14px;
    color: var(--text-dark);
}
.filter-search button {
    background: var(--maroon);
    border: none;
    color: white;
    padding: 10px 14px;
    cursor: pointer;
    transition: background 0.2s;
}
.filter-search button:hover { background: var(--maroon-dark); }

/* ===== PRODUCT LISTING ===== */
.products-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    gap: 16px;
    flex-wrap: wrap;
}
.products-topbar h2 {
    font-family: 'Signika', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--maroon);
}
.products-topbar .count { font-size: 14px; color: var(--text-light); }
.sort-select {
    padding: 9px 14px;
    border: 2px solid var(--cream-dark);
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-dark);
    background: white;
    outline: none;
    cursor: pointer;
    font-family: 'Open Sans', sans-serif;
}
.sort-select:focus { border-color: var(--maroon); }

.products-listing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 24px;
}

/* Product card extended */
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
}
.card-order-btn:hover { background: var(--gold); }

/* Empty state */
.products-empty {
    text-align: center;
    padding: 80px 24px;
    grid-column: 1/-1;
}
.products-empty i { font-size: 64px; color: var(--cream-dark); margin-bottom: 20px; }
.products-empty h3 {
    font-family: 'Signika', sans-serif;
    font-size: 22px;
    color: var(--text-mid);
    margin-bottom: 8px;
}
.products-empty p { color: var(--text-light); font-size: 15px; }

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 48px;
}
.pagination a, .pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'Signika', sans-serif;
    transition: all 0.2s;
    border: 2px solid var(--cream-dark);
    color: var(--text-mid);
    background: white;
}
.pagination a:hover { border-color: var(--maroon); color: var(--maroon); }
.pagination .active { background: var(--maroon); color: white; border-color: var(--maroon); }

/* Responsive */
@media (max-width: 900px) {
    .products-page-inner { grid-template-columns: 1fr; }
    .sidebar { position: static; }
}
@media (max-width: 600px) {
    .products-listing-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> &rsaquo; Products
    </div>
    <h1>Our Products</h1>
    <p>Browse our full range of handcrafted cakes, pastries, desserts &amp; more</p>
</section>

<!-- Drip transition -->
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

<!-- Products Main Area -->
<div class="products-page">
    <div class="products-page-inner">

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Search -->
            <div class="sidebar-card">
                <h3>Search</h3>
                <form method="GET" action="{{ route('products.index') }}">
                    <div class="filter-search">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search products..."
                        >
                        <button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <!-- Categories -->
            <div class="sidebar-card">
                <h3>Categories</h3>
                <ul class="category-filter-list">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="{{ !request('category') ? 'active' : '' }}">
                            All Products
                            <span class="count">{{ isset($allCount) ? $allCount : '' }}</span>
                        </a>
                    </li>
                    @if(isset($categories) && $categories->count())
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="{{ request('category') === $category->slug ? 'active' : '' }}">
                                {{ $category->name }}
                                <span class="count">{{ $category->products_count ?? '' }}</span>
                            </a>
                        </li>
                        @endforeach
                    @else
                        @php
                            $demoCategories = [
                                ['name'=>'Cakes','slug'=>'cakes','count'=>12],
                                ['name'=>'Cheese Cream Cakes','slug'=>'cheese-cream-cakes','count'=>6],
                                ['name'=>'Pastries','slug'=>'pastries','count'=>9],
                                ['name'=>'French Macarons','slug'=>'french-macarons','count'=>4],
                                ['name'=>'Triffles','slug'=>'triffles','count'=>5],
                                ['name'=>'Desserts','slug'=>'desserts','count'=>8],
                            ];
                        @endphp
                        @foreach ($demoCategories as $cat)
                        <li>
                            <a href="{{ route('products.index', ['category' => $cat['slug']]) }}"
                               class="{{ request('category') === $cat['slug'] ? 'active' : '' }}">
                                {{ $cat['name'] }}
                                <span class="count">{{ $cat['count'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Order via WhatsApp -->
            <div class="sidebar-card" style="background:var(--maroon);text-align:center;">
                <i class="fa-brands fa-whatsapp" style="font-size:40px;color:var(--gold);margin-bottom:12px;display:block;"></i>
                <h3 style="color:white;border-bottom-color:rgba(255,255,255,0.15);">Order on WhatsApp</h3>
                <p style="font-size:13px;color:rgba(255,255,255,0.75);margin-bottom:16px;line-height:1.6;">
                    Chat with us instantly to place your custom order or ask questions.
                </p>
                <a href="https://wa.me/919895588988" target="_blank" class="btn-gold" style="display:block;text-align:center;">
                    Chat Now
                </a>
            </div>
        </aside>

        <!-- Product Listing -->
        <div>
            <!-- Topbar -->
            <div class="products-topbar">
                <div>
                    <h2>
                        @if(request('category'))
                            {{ ucwords(str_replace('-', ' ', request('category'))) }}
                        @else
                            All Products
                        @endif
                    </h2>
                    <p class="count">
                        @if(isset($products) && $products->count())
                            Showing {{ $products->count() }} products
                        @else
                            Showing demo products
                        @endif
                    </p>
                </div>
                <select class="sort-select" id="sortSelect" onchange="window.location.href=this.value">
                    <option value="{{ route('products.index', ['sort'=>'default','category'=>request('category')]) }}">Default Sorting</option>
                    <option value="{{ route('products.index', ['sort'=>'price_asc','category'=>request('category')]) }}" {{ request('sort')=='price_asc'?'selected':'' }}>Price: Low to High</option>
                    <option value="{{ route('products.index', ['sort'=>'price_desc','category'=>request('category')]) }}" {{ request('sort')=='price_desc'?'selected':'' }}>Price: High to Low</option>
                    <option value="{{ route('products.index', ['sort'=>'name','category'=>request('category')]) }}" {{ request('sort')=='name'?'selected':'' }}>Name A–Z</option>
                </select>
            </div>

            <!-- Products Grid -->
            <div class="products-listing-grid">
                @php
                    $demoProducts = [
                        ['name'=>'Classic Chocolate Cake','cat'=>'Cakes','desc'=>'Rich, moist layers of premium Belgian chocolate cake.','price'=>'₹549','img'=>'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=500','badge'=>'Bestseller'],
                        ['name'=>'Red Velvet Cake','cat'=>'Cakes','desc'=>'Show-stopping red velvet with cream cheese frosting.','price'=>'₹599','img'=>'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?q=80&w=500','badge'=>null],
                        ['name'=>'Cheese Cream Cake','cat'=>'Cheese Cream','desc'=>'Velvety cheesecake on a buttery biscuit base.','price'=>'₹649','img'=>'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500','badge'=>'Popular'],
                        ['name'=>'Baked Cheesecake','cat'=>'Cheese Cream','desc'=>'Classic New-York style baked cheesecake.','price'=>'₹699','img'=>'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=500','badge'=>null],
                        ['name'=>'French Macarons','cat'=>'Macarons','desc'=>'Delicate almond shells with flavoured ganache fillings.','price'=>'₹349','img'=>'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=500','badge'=>'New'],
                        ['name'=>'Butter Croissant','cat'=>'Pastries','desc'=>'Flaky, golden layers of pure butter pastry.','price'=>'₹149','img'=>'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=500','badge'=>null],
                        ['name'=>'Fruit Tart','cat'=>'Pastries','desc'=>'Crisp pastry shell with cream and seasonal fruits.','price'=>'₹299','img'=>'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=500','badge'=>null],
                        ['name'=>'Strawberry Triffle','cat'=>'Desserts','desc'=>'Layered sponge, custard, cream and fresh strawberries.','price'=>'₹249','img'=>'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=500','badge'=>'Popular'],
                    ];
                @endphp

                @if(isset($products) && $products->count())
                    @foreach ($products as $product)
                    <article class="product-card-lg">
                        <div class="card-img-wrap">
                            <img
                                src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500' }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                            >
                        </div>
                        <div class="card-body">
                            @if($product->category)
                            <div class="card-category">{{ $product->category->name }}</div>
                            @endif
                            <div class="card-title">{{ $product->name }}</div>
                            <div class="card-desc">{{ Str::limit($product->description, 80) }}</div>
                            <div class="card-footer">
                                <div class="card-price">₹{{ number_format($product->base_price, 2) }}</div>
                                <button class="card-order-btn">Order Now</button>
                            </div>
                        </div>
                    </article>
                    @endforeach
                @else
                    @foreach ($demoProducts as $p)
                    <article class="product-card-lg">
                        <div class="card-img-wrap">
                            @if($p['badge'])
                                <div class="card-badge">{{ $p['badge'] }}</div>
                            @endif
                            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy">
                        </div>
                        <div class="card-body">
                            <div class="card-category">{{ $p['cat'] }}</div>
                            <div class="card-title">{{ $p['name'] }}</div>
                            <div class="card-desc">{{ $p['desc'] }}</div>
                            <div class="card-footer">
                                <div class="card-price">{{ $p['price'] }}</div>
                                <a href="https://wa.me/919895588988?text=I want to order: {{ urlencode($p['name']) }}" target="_blank" class="card-order-btn">Order Now</a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($products) && method_exists($products, 'links'))
                <div class="pagination">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
