@extends('layouts.app')
@section('title', 'Shop | Cake Atelier')
@section('meta_description', 'Browse our full range of handcrafted cakes, pastries, cupcakes and desserts.')

@push('styles')
<style>
.products-page { background: var(--off-white); padding: 64px 0 100px; }
.products-layout {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
    display: flex;
    gap: 48px;
    align-items: flex-start;
}

/* Sidebar */
.sidebar { width: 220px; flex-shrink: 0; position: sticky; top: 96px; }
.sidebar-block { margin-bottom: 36px; }
.sidebar-title {
    font-family: 'Jost', sans-serif;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border);
}
.sidebar-search {
    display: flex;
    border: 1px solid var(--border);
    border-radius: 4px;
    overflow: hidden;
    background: var(--white);
}
.sidebar-search input {
    flex: 1;
    border: none;
    outline: none;
    padding: 10px 14px;
    font-size: 13px;
    font-family: 'Jost', sans-serif;
    background: transparent;
    color: var(--dark);
}
.sidebar-search button {
    background: var(--teal);
    border: none;
    color: white;
    padding: 10px 14px;
    cursor: pointer;
    font-size: 13px;
}

/* Category list */
.cat-list { display: flex; flex-direction: column; gap: 4px; }
.cat-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid var(--off-white);
    font-size: 14px;
    color: var(--body);
    cursor: pointer;
    transition: color 0.2s;
}
.cat-item:hover, .cat-item.active { color: var(--teal); }
.cat-count {
    font-size: 12px;
    color: var(--muted);
    background: var(--off-white);
    padding: 2px 8px;
    border-radius: 2px;
}

/* Main products area */
.products-main { flex: 1; min-width: 0; }
.products-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
    flex-wrap: wrap;
    gap: 12px;
}
.products-count {
    font-size: 14px;
    color: var(--muted);
}
.sort-select {
    border: 1px solid var(--border);
    border-radius: 4px;
    padding: 8px 14px;
    font-size: 13px;
    font-family: 'Jost', sans-serif;
    color: var(--dark);
    background: var(--white);
    outline: none;
    cursor: pointer;
}

/* Category tabs (top filter) */
.cat-tabs {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 32px;
    border-bottom: 2px solid var(--border);
    overflow-x: auto;
}
.cat-tab {
    font-family: 'Jost', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    padding: 10px 20px;
    white-space: nowrap;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}
.cat-tab:hover { color: var(--teal); }
.cat-tab.active { color: var(--teal); border-bottom-color: var(--teal); }

/* Product grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 36px 28px;
}

/* Pagination */
.pagination { display: flex; align-items: center; gap: 8px; margin-top: 56px; }
.page-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 14px;
    color: var(--body);
    font-family: 'Jost', sans-serif;
    cursor: pointer;
    transition: all 0.2s;
}
.page-btn:hover, .page-btn.active { background: var(--teal); border-color: var(--teal); color: white; }

/* Empty state */
.empty-state {
    grid-column: 1/-1;
    text-align: center;
    padding: 80px 24px;
}
.empty-state i { font-size: 56px; color: var(--border); margin-bottom: 20px; }
.empty-state h3 { font-family: 'Playfair Display', serif; font-size: 24px; color: var(--dark); margin-bottom: 10px; }
.empty-state p { font-size: 14px; color: var(--muted); margin-bottom: 24px; }

@media (max-width: 900px) {
    .sidebar { display: none; }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
    .product-grid { grid-template-columns: 1fr 1fr; gap: 16px; }
}
</style>
@endpush

@section('content')

<!-- Page Banner -->
<div class="page-banner">
    <div>
        <h1>Shop</h1>
    </div>
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span>Shop</span>
    </nav>
</div>

<div class="products-page">
    <div class="products-layout">

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-block">
                <div class="sidebar-title">Search</div>
                <form action="{{ route('products.index') }}" method="GET">
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    <div class="sidebar-search">
                        <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}">
                        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="sidebar-block">
                <div class="sidebar-title">Categories</div>
                <div class="cat-list">
                    <a href="{{ route('products.index') }}" class="cat-item {{ !request('category') ? 'active' : '' }}" style="text-decoration:none;">
                        All Products
                        <span class="cat-count">{{ $allCount ?? 0 }}</span>
                    </a>
                    @foreach(($categories ?? []) as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="cat-item {{ request('category') == $cat->slug ? 'active' : '' }}" style="text-decoration:none;">
                        {{ $cat->name }}
                        <span class="cat-count">{{ $cat->products_count ?? 0 }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Main Products -->
        <div class="products-main">

            <!-- Toolbar -->
            <div class="products-toolbar">
                <div class="products-count">
                    @if(method_exists($products, 'total'))
                        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} products
                    @else
                        Showing demo products
                    @endif
                    @if(request('q')) &mdash; Results for "<strong>{{ request('q') }}</strong>" @endif
                </div>
                <form action="{{ route('products.index') }}" method="GET">
                    @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
                    @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
                    <select class="sort-select" name="sort" onchange="this.form.submit()">
                        <option value="" {{ !request('sort') ? 'selected' : '' }}>Default Sorting</option>
                        <option value="name" {{ request('sort')=='name' ? 'selected' : '' }}>Name (A–Z)</option>
                        <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                @php
                    $demo = [
                        ['name'=>'Chaat Delicacies','cat'=>'SPECIAL','price'=>'₹199','badge'=>null,'img'=>'https://images.unsplash.com/photo-1606491048802-8342506d6471?q=80&w=600'],
                        ['name'=>'Classic Tarts','cat'=>'PREMIUM','price'=>'₹249','badge'=>'Popular','img'=>'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=600'],
                        ['name'=>'Cheese Cream Cake','cat'=>'PREMIUM','price'=>'₹549','badge'=>'Bestseller','img'=>'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600'],
                        ['name'=>'French Macarons','cat'=>'SPECIAL','price'=>'₹349','badge'=>null,'img'=>'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=600'],
                        ['name'=>'Butter Pastries','cat'=>'DAILY','price'=>'₹179','badge'=>null,'img'=>'https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=600'],
                        ['name'=>'Strawberry Triffle','cat'=>'SPECIAL','price'=>'₹299','badge'=>'New','img'=>'https://images.unsplash.com/photo-1488477181946-6428a0291777?q=80&w=600'],
                        ['name'=>'Red Velvet Cake','cat'=>'PREMIUM','price'=>'₹599','badge'=>null,'img'=>'https://images.unsplash.com/photo-1614707267537-b85aaf00c4b7?q=80&w=600'],
                        ['name'=>'Baked Cheesecake','cat'=>'PREMIUM','price'=>'₹699','badge'=>null,'img'=>'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=600'],
                        ['name'=>'Black Forest Cake','cat'=>'SPECIAL','price'=>'₹499','badge'=>null,'img'=>'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?q=80&w=600'],
                    ];
                @endphp

                @if(isset($products) && method_exists($products,'count') && $products->count())
                    @foreach($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="product-card" style="text-decoration:none;">
                        <div class="product-card-img">
                            <img src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=600' }}" alt="{{ $product->name }}" loading="lazy">
                        </div>
                        @if($product->category)<div class="product-card-cat">{{ $product->category->name }}</div>@endif
                        <div class="product-card-name">{{ $product->name }}</div>
                        <div class="product-card-price">₹{{ number_format($product->base_price, 2) }}</div>
                    </a>
                    @endforeach
                @else
                    @foreach($demo as $p)
                    <a href="{{ route('customized') }}" class="product-card" style="text-decoration:none;">
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

                @if(isset($products) && method_exists($products,'count') && $products->count() === 0)
                <div class="empty-state">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h3>No products found</h3>
                    <p>We couldn't find any products matching your search. Try a different filter or browse all products.</p>
                    <a href="{{ route('products.index') }}" class="btn-teal">Browse All Products</a>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(isset($products) && method_exists($products,'hasPages') && $products->hasPages())
            <div class="pagination">
                @if($products->onFirstPage())
                    <span class="page-btn" style="opacity:.4;cursor:default;">&larr;</span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="page-btn">&larr;</a>
                @endif

                @foreach($products->getUrlRange(1,$products->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $page == $products->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="page-btn">&rarr;</a>
                @else
                    <span class="page-btn" style="opacity:.4;cursor:default;">&rarr;</span>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
