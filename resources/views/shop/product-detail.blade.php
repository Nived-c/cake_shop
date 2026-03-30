@extends('layouts.app')

@section('title', isset($product) ? $product->name . ' | Cake Atelier' : 'Product | Cake Atelier')
@section('meta_description', isset($product) ? Str::limit($product->description, 160) : 'Premium custom cakes and pastries.')

@push('styles')
<style>
.page-hero {
    background: var(--maroon);
    padding: 40px 24px;
    position: relative;
    overflow: hidden;
}
.breadcrumb { font-size: 13px; color: rgba(255,255,255,0.65); position: relative; z-index: 2; }
.breadcrumb a { color: var(--gold); }
.drip-down { background: var(--maroon); line-height: 0; }
.drip-down svg { width: 100%; height: 70px; display: block; }

/* ===== PRODUCT DETAIL ===== */
.product-detail-section { background: var(--cream); padding: 60px 0 80px; }
.product-detail-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Main detail grid */
.product-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
    margin-bottom: 80px;
}

/* Image gallery */
.product-main-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    border-radius: 14px;
    box-shadow: 0 12px 40px rgba(101,6,50,0.15);
    margin-bottom: 12px;
}
.product-thumb-row {
    display: flex;
    gap: 10px;
}
.product-thumb {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: border-color 0.2s;
}
.product-thumb:hover,
.product-thumb.active { border-color: var(--maroon); }

/* Product Info */
.product-info .category-tag {
    font-size: 12px;
    font-weight: 700;
    font-family: 'Signika', sans-serif;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--gold);
    margin-bottom: 8px;
}
.product-info h1 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(24px, 3.5vw, 36px);
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 12px;
}
.product-price {
    font-family: 'Signika', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 20px;
}
.product-price .from {
    font-size: 14px;
    font-weight: 400;
    color: var(--text-light);
}
.product-info .desc {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.85;
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--cream-dark);
}

/* Variations */
.variations-label {
    font-family: 'Signika', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 10px;
}
.variation-pills { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; }
.variation-pill {
    padding: 8px 18px;
    border-radius: 50px;
    border: 2px solid var(--cream-dark);
    font-size: 13px;
    font-family: 'Signika', sans-serif;
    font-weight: 600;
    color: var(--text-mid);
    cursor: pointer;
    background: white;
    transition: all 0.2s;
}
.variation-pill:hover,
.variation-pill.selected { border-color: var(--maroon); color: var(--maroon); background: rgba(101,6,50,0.05); }

/* CTA */
.product-cta { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 28px; }
.product-cta .btn-maroon, .product-cta .btn-gold { flex: 1; min-width: 140px; text-align: center; font-size: 15px; padding: 14px 20px; }

/* Dietary tags */
.dietary-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.dietary-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: white;
    border: 1px solid var(--cream-dark);
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 12px;
    color: var(--text-mid);
    font-weight: 600;
}
.dietary-tag i { color: var(--gold); }

/* Related products */
.related-section {}
.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 24px;
    margin-top: 36px;
}

@media (max-width: 860px) {
    .product-detail-grid { grid-template-columns: 1fr; gap: 32px; }
}
</style>
@endpush

@section('content')

<section class="page-hero">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a> &rsaquo;
        <a href="{{ route('products.index') }}">Products</a>
        @if(isset($product) && $product->category)
            &rsaquo; <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
        @endif
        &rsaquo; {{ isset($product) ? $product->name : 'Product Detail' }}
    </div>
</section>

<div class="drip-down">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 L0,30 Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38 Q350,65 390,35 Q430,5 470,35 Q510,65 550,38 Q590,10 630,38 Q670,66 710,38 Q750,10 790,35 Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38 Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35 Q1310,60 1350,38 Q1390,15 1440,35 L1440,0 Z" fill="var(--cream)"/>
    </svg>
</div>

<div class="product-detail-section">
    <div class="product-detail-inner">

        @if(isset($product))
        <div class="product-detail-grid">
            <!-- Images -->
            <div>
                <img
                    id="mainProductImg"
                    src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=700' }}"
                    alt="{{ $product->name }}"
                    class="product-main-img"
                >
                @if($product->images && $product->images->count())
                <div class="product-thumb-row">
                    <img src="{{ Storage::url($product->thumbnail) }}" class="product-thumb active" onclick="swapImage(this)" alt="{{ $product->name }}">
                    @foreach($product->images as $img)
                    <img src="{{ Storage::url($img->image_path) }}" class="product-thumb" onclick="swapImage(this)" alt="{{ $product->name }}">
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Info -->
            <div class="product-info">
                @if($product->category)
                <div class="category-tag">{{ $product->category->name }}</div>
                @endif

                <h1>{{ $product->name }}</h1>

                <div class="product-price">
                    <span class="from">From </span>
                    ₹{{ number_format($product->base_price, 2) }}
                </div>

                <p class="desc">{{ $product->description }}</p>

                <!-- Variations -->
                @if($product->variations && $product->variations->count())
                <div class="variations-label">Choose Size / Variant:</div>
                <div class="variation-pills">
                    @foreach($product->variations as $v)
                    <div class="variation-pill" onclick="selectVariation(this, '{{ $v->price }}')">
                        {{ $v->name }}
                        @if($v->price) — ₹{{ number_format($v->price, 0) }}@endif
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- CTA Buttons -->
                <div class="product-cta">
                    <a href="https://wa.me/919895588988?text=I want to order: {{ urlencode($product->name) }}"
                       target="_blank" class="btn-maroon">
                        <i class="fa-brands fa-whatsapp"></i> Order Now
                    </a>
                    <a href="{{ route('customized') }}" class="btn-gold">
                        <i class="fa-solid fa-pencil"></i> Customise This
                    </a>
                </div>

                <!-- Dietary Info -->
                @if($product->dietary_info)
                <div class="dietary-tags">
                    @foreach(explode(',', $product->dietary_info) as $tag)
                    <span class="dietary-tag"><i class="fa-solid fa-leaf"></i> {{ trim($tag) }}</span>
                    @endforeach
                </div>
                @endif

                <!-- Assurance badges -->
                <div style="display:flex;gap:20px;margin-top:24px;flex-wrap:wrap;">
                    <div style="font-size:13px;color:var(--text-mid);display:flex;align-items:center;gap:6px;">
                        <i class="fa-solid fa-shield-halved" style="color:var(--gold);"></i> Fresh Daily
                    </div>
                    <div style="font-size:13px;color:var(--text-mid);display:flex;align-items:center;gap:6px;">
                        <i class="fa-solid fa-truck-fast" style="color:var(--gold);"></i> Quick Delivery
                    </div>
                    <div style="font-size:13px;color:var(--text-mid);display:flex;align-items:center;gap:6px;">
                        <i class="fa-solid fa-award" style="color:var(--gold);"></i> Premium Quality
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(isset($related) && $related->count())
        <div class="related-section">
            <p class="section-title" style="text-align:left;">You May Also Like</p>
            <div class="section-underline" style="margin:10px 0 0;"></div>
            <div class="related-grid">
                @foreach($related as $rel)
                <a href="{{ route('products.show', $rel->slug) }}" class="product-card-lg" style="display:block;text-decoration:none;">
                    <div class="card-img-wrap">
                        <img src="{{ $rel->thumbnail ? Storage::url($rel->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500' }}"
                             alt="{{ $rel->name }}" loading="lazy">
                    </div>
                    <div class="card-body">
                        @if($rel->category)
                        <div class="card-category">{{ $rel->category->name }}</div>
                        @endif
                        <div class="card-title">{{ $rel->name }}</div>
                        <div class="card-footer" style="padding-top:8px;border-top:1px solid var(--cream-dark);display:flex;justify-content:space-between;align-items:center;">
                            <span style="font-family:'Signika',sans-serif;font-size:16px;font-weight:700;color:var(--maroon);">₹{{ number_format($rel->base_price, 0) }}</span>
                            <span class="card-order-btn">View</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        @else
        <!-- Fallback if no product passed -->
        <div style="text-align:center;padding:80px 24px;">
            <i class="fa-solid fa-cake-candles" style="font-size:64px;color:var(--cream-dark);margin-bottom:20px;display:block;"></i>
            <h2 style="font-family:'Signika',sans-serif;color:var(--text-mid);margin-bottom:12px;">Product not found</h2>
            <p style="color:var(--text-light);margin-bottom:24px;">The product you're looking for may not be available right now.</p>
            <a href="{{ route('products.index') }}" class="btn-maroon">Browse All Products</a>
        </div>
        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
function swapImage(thumb) {
    document.getElementById('mainProductImg').src = thumb.src;
    document.querySelectorAll('.product-thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}

function selectVariation(pill, price) {
    document.querySelectorAll('.variation-pill').forEach(p => p.classList.remove('selected'));
    pill.classList.add('selected');
    if (price) {
        document.querySelector('.product-price').innerHTML =
            '<span class="from">Price: </span>₹' + parseFloat(price).toFixed(2);
    }
}
</script>
@endpush
