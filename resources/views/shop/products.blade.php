@extends('layouts.app')

@section('title', 'Cakes | L\'Atelier')
@section('meta_description', 'Browse our full luxury collection of handcrafted cakes, pastries, and desserts.')

@push('styles')
<style>
/* Page Header Override for Products */
.page-header {
    background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
}

/* Products Layout */
.products-page {
    padding: 60px 40px 100px;
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 60px;
}

/* ===== SIDEBAR ===== */
.sidebar {
    position: sticky;
    top: 120px;
}
.sidebar-box {
    margin-bottom: 40px;
}
.sidebar-title {
    font-family: var(--font-display);
    font-size: 0.8rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--color-accent);
    margin-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    padding-bottom: 10px;
}
.cat-list { list-style: none; }
.cat-list li { margin-bottom: 12px; }
.cat-list a {
    display: flex; justify-content: space-between; align-items: center;
    font-family: var(--font-serif);
    font-size: 1.1rem;
    color: var(--color-text-dim);
    transition: color 0.3s;
}
.cat-list a:hover, .cat-list a.active { color: var(--color-accent); }
.cat-list a .count { font-size: 0.9rem; font-style: italic; }

/* Filter Search */
.filter-search {
    display: flex; align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    padding-bottom: 5px;
    transition: border-color 0.3s;
}
.filter-search:focus-within { border-color: var(--color-accent); }
.filter-search input {
    background: transparent; border: none; outline: none;
    color: var(--color-text); font-family: var(--font-serif); font-size: 1.1rem;
    flex: 1; padding: 5px; padding-left: 0;
}
.filter-search button {
    background: transparent; border: none; color: var(--color-accent);
    cursor: pointer; font-size: 1rem;
}

/* ===== PRODUCT GRID ===== */
.products-top {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 20px;
}
.products-count { font-family: var(--font-serif); font-style: italic; color: var(--color-text-dim); }
.sort-select {
    background: transparent; border: none; outline: none;
    color: var(--color-text); font-family: var(--font-display);
    text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.7rem;
    cursor: pointer; appearance: none;
}
.sort-select option { background: var(--color-bg-light); color: var(--color-text); }

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 40px;
}

/* Custom Product Card */
.product-card {
    display: block;
    text-decoration: none;
    group;
}
.product-card-img {
    width: 100%; height: 360px; object-fit: cover;
    filter: brightness(0.8) contrast(1.1);
    transition: all 0.6s cubic-bezier(0.215, 0.610, 0.355, 1);
}
.product-card:hover .product-card-img {
    filter: brightness(1) contrast(1.1);
    transform: scale(1.03);
}
.product-card-info {
    padding-top: 20px; text-align: center;
}
.product-cat {
    font-family: var(--font-display); font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase;
    color: var(--color-text-dim); margin-bottom: 8px;
}
.product-name {
    font-family: var(--font-serif); font-size: 1.4rem; color: var(--color-text);
    margin-bottom: 5px; transition: color 0.3s;
}
.product-card:hover .product-name { color: var(--color-accent); }
.product-price {
    font-family: var(--font-serif); font-style: italic; color: var(--color-accent); font-size: 1.1rem;
}

/* Pagination */
.pagination {
    display: flex; justify-content: center; gap: 10px; margin-top: 60px;
}
.pagination a, .pagination span {
    font-family: var(--font-display); font-size: 0.8rem;
    padding: 10px 15px; border: 1px solid rgba(255,255,255,0.1);
    color: var(--color-text); transition: all 0.3s;
}
.pagination a:hover { border-color: var(--color-accent); color: var(--color-accent); }
.pagination .active { background: var(--color-accent); color: #000; border-color: var(--color-accent); }

@media (max-width: 900px) {
    .products-page { grid-template-columns: 1fr; padding: 40px 20px; }
    .sidebar { position: static; }
}
</style>
@endpush

@section('content')

<section class="page-header reveal">
    <div class="page-header-inner">
        <h1 class="section-title-cursive">Cakes</h1>
        <div class="section-subtitle-serif">
            @if(request('category'))
                {{ ucwords(str_replace('-', ' ', request('category'))) }}
            @else
                The Full Anthology
            @endif
        </div>
    </div>
</section>

<div class="products-page">
    
    <!-- Sidebar -->
    <aside class="sidebar reveal">
        <div class="sidebar-box">
            <h3 class="sidebar-title">Search</h3>
            <form method="GET" action="{{ route('products.index') }}" class="filter-search">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Find a signature...">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>

        <div class="sidebar-box">
            <h3 class="sidebar-title">Categories</h3>
            <ul class="cat-list">
                <li>
                    <a href="{{ route('products.index') }}" class="{{ !request('category') ? 'active' : '' }}">
                        All Creations
                    </a>
                </li>
                @if(isset($categories) && $categories->count())
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="{{ request('category') === $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                @else
                    @php
                        $demoCategories = [
                            ['name'=>'Signature Cakes','slug'=>'cakes'],
                            ['name'=>'Artisanal Pastries','slug'=>'pastries'],
                            ['name'=>'Macarons','slug'=>'macarons'],
                            ['name'=>'Custom Cakes Desserts','slug'=>'desserts'],
                        ];
                    @endphp
                    @foreach($demoCategories as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat['slug']]) }}"
                           class="{{ request('category') === $cat['slug'] ? 'active' : '' }}">
                            {{ $cat['name'] }}
                        </a>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
        
        <div class="sidebar-box mt-5">
            <a href="https://wa.me/000000" class="btn-outline" style="width:100%; text-align:center; padding: 12px;">Custom Cakes Inquiry</a>
        </div>
    </aside>

    <!-- Grid -->
    <div>
        <div class="products-top reveal" style="transition-delay: 0.2s">
            <div class="products-count">
                @if(isset($products) && $products->count())
                    Showing {{ $products->count() }} culinary works
                @else
                    Showing curated anthology
                @endif
            </div>
            <select class="sort-select" onchange="window.location.href=this.value">
                <option value="{{ route('products.index', ['sort'=>'default','category'=>request('category')]) }}">Sort: Curated</option>
                <option value="{{ route('products.index', ['sort'=>'price_asc','category'=>request('category')]) }}" {{ request('sort')=='price_asc'?'selected':'' }}>Sort: Value</option>
                <option value="{{ route('products.index', ['sort'=>'price_desc','category'=>request('category')]) }}" {{ request('sort')=='price_desc'?'selected':'' }}>Sort: Premium</option>
            </select>
        </div>

        <div class="products-grid">
            @php
                $demoProducts = [
                    ['name'=>'Noir Chocolate Velvet','cat'=>'Cakes','price'=>'AED 549','img'=>'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=600'],
                    ['name'=>'Classic Rouge','cat'=>'Cakes','price'=>'AED 599','img'=>'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?q=80&w=600'],
                    ['name'=>'Vanilla Orchid Creme','cat'=>'Cheese Cream','price'=>'AED 649','img'=>'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600'],
                    ['name'=>'New York Artisanal','cat'=>'Cheese Cream','price'=>'AED 699','img'=>'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=600'],
                    ['name'=>'Pistachio Macarons','cat'=>'Macarons','price'=>'AED 349','img'=>'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=600'],
                    ['name'=>'Golden Croissant','cat'=>'Pastries','price'=>'AED 149','img'=>'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600'],
                ];
            @endphp

            @if(isset($products) && $products->count())
                @foreach($products as $index => $product)
                <a href="{{ route('products.show', $product->slug ?? $product->id) }}" class="product-card reveal" style="transition-delay: {{ ($index % 3) * 0.1 }}s">
                    <div style="overflow: hidden; border-radius: 4px;">
                        <img src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600' }}" alt="{{ $product->name }}" class="product-card-img">
                    </div>
                    <div class="product-card-info">
                        @if($product->category)
                        <div class="product-cat">{{ $product->category->name }}</div>
                        @endif
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">AED {{ number_format($product->base_price, 0) }}</div>
                    </div>
                </a>
                @endforeach
            @else
                @foreach($demoProducts as $index => $p)
                <a href="https://wa.me/000000?text=Inquiry regarding {{ urlencode($p['name']) }}" target="_blank" class="product-card reveal" style="transition-delay: {{ ($index % 3) * 0.1 }}s">
                    <div style="overflow: hidden; border-radius: 4px;">
                        <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" class="product-card-img">
                    </div>
                    <div class="product-card-info">
                        <div class="product-cat">{{ $p['cat'] }}</div>
                        <div class="product-name">{{ $p['name'] }}</div>
                        <div class="product-price">{{ $p['price'] }}</div>
                    </div>
                </a>
                @endforeach
            @endif
        </div>

        @if(isset($products) && method_exists($products, 'links'))
            <div class="pagination reveal">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
