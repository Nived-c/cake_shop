@extends('layouts.app')

@section('title', isset($product) ? $product->name . ' | L\'Atelier' : 'Product | L\'Atelier')
@section('meta_description', isset($product) ? Str::limit($product->description, 160) : 'Premium custom cakes and pastries.')

@push('styles')
<style>
/* Page Header Override for Detail */
.page-header {
    background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
    padding: 180px 20px 80px;
}

.product-detail-page {
    max-width: 1200px;
    margin: -100px auto 100px;
    padding: 0 40px;
    position: relative;
    z-index: 10;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 80px;
}

/* Image Gallery */
.gallery { position: sticky; top: 120px; }
.main-img {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 4px;
    filter: brightness(0.85) contrast(1.1);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    margin-bottom: 20px;
}
.thumb-row { display: flex; gap: 15px; }
.thumb {
    width: 80px; height: 80px; object-fit: cover;
    cursor: pointer; opacity: 0.5; transition: all 0.3s;
    border: 1px solid transparent;
}
.thumb.active, .thumb:hover { opacity: 1; border-color: var(--color-accent); }

/* Info Area */
.info-area {
    background: rgba(18, 18, 18, 0.6);
    backdrop-filter: blur(10px);
    padding: 60px;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 4px;
}
.cat-tag {
    font-family: var(--font-display);
    font-size: 0.75rem; letter-spacing: 0.3em;
    text-transform: uppercase; color: var(--color-accent);
    margin-bottom: 15px;
}
.title-script {
    font-family: var(--font-script);
    font-size: clamp(50px, 8vw, 90px);
    line-height: 0.8;
    color: var(--color-text);
    margin-bottom: 30px;
    text-shadow: 0 5px 15px rgba(0,0,0,0.5);
    font-weight: normal;
}
.price {
    font-family: var(--font-serif);
    font-style: italic;
    font-size: 2rem;
    color: var(--color-accent);
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.desc {
    font-family: var(--font-serif);
    font-size: 1.15rem;
    line-height: 1.8;
    color: var(--color-text-dim);
    margin-bottom: 40px;
}

/* Attributes / Variations */
.variation-label {
    font-family: var(--font-display);
    font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--color-text); margin-bottom: 15px;
}
.pills { display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 40px; }
.pill {
    font-family: var(--font-serif);
    font-size: 1.1rem;
    padding: 10px 25px;
    border: 1px solid rgba(255,255,255,0.1);
    color: var(--color-text-dim);
    cursor: pointer; transition: all 0.3s;
}
.pill:hover, .pill.selected {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

.cta-row { display: flex; gap: 20px; }
.cta-row .btn-outline { flex: 1; text-align: center; }

/* Related section */
.related { margin-top: 120px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 80px; }
.related-title {
    font-family: var(--font-script); font-size: 50px; color: var(--color-accent);
    margin-bottom: 40px; text-align: center; font-weight: normal;
}
.related-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 40px;
}

@media (max-width: 900px) {
    .detail-grid { grid-template-columns: 1fr; }
    .gallery { position: static; }
    .info-area { padding: 40px 20px; }
    .main-img { height: 400px; }
}
</style>
@endpush

@section('content')

<section class="page-header" style="padding-top: 60px;">
    <!-- empty header logic -->
</section>

<div class="product-detail-page">
    
    @if(isset($product))
    <div class="detail-grid">
        <!-- Gallery -->
        <div class="gallery reveal">
            <img id="mainImg" src="{{ $product->thumbnail ? Storage::url($product->thumbnail) : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=700' }}" alt="{{ $product->name }}" class="main-img">
            @if($product->images && $product->images->count())
            <div class="thumb-row">
                <img src="{{ Storage::url($product->thumbnail) }}" class="thumb active" onclick="swapImage(this)" alt="{{ $product->name }}">
                @foreach($product->images as $img)
                <img src="{{ Storage::url($img->image_path) }}" class="thumb" onclick="swapImage(this)" alt="{{ $product->name }}">
                @endforeach
            </div>
            @endif
        </div>

        <!-- Info -->
        <div class="info-area reveal" style="transition-delay: 0.2s">
            @if($product->category)
            <div class="cat-tag">{{ $product->category->name }}</div>
            @endif
            
            <h1 class="title-script">{{ $product->name }}</h1>
            <div class="price" id="priceDisplay">AED {{ number_format($product->base_price, 0) }}</div>
            
            <p class="desc">{{ $product->description }}</p>

            @if($product->variations && $product->variations->count())
            <div class="variation-label">Artisanal Variations</div>
            <div class="pills">
                @foreach($product->variations as $v)
                <div class="pill" onclick="selectVar(this, '{{ $v->price }}')">
                    {{ $v->name }}
                </div>
                @endforeach
            </div>
            @endif

            <div class="cta-row">
                <a href="https://wa.me/000000?text={{ urlencode('Inquiry for ' . $product->name) }}" target="_blank" class="btn-solid">Commission Order</a>
                <a href="{{ route('customized') }}" class="btn-outline">Modify Design</a>
            </div>

            <!-- Diet/Quality Info -->
            <div style="margin-top: 50px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 30px;">
                <div class="variation-label" style="margin-bottom: 5px;">Quality Assurance</div>
                <div style="font-family: var(--font-serif); font-size: 1.1rem; color: var(--color-text-dim); display:flex; gap: 30px;">
                    <span><i class="fa-solid fa-leaf" style="color:var(--color-accent); margin-right:8px;"></i> Pure Ingredients</span>
                    <span><i class="fa-solid fa-clock" style="color:var(--color-accent); margin-right:8px;"></i> Crafted to Order</span>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Fallback -->
    <div style="text-align: center; padding: 100px 0; color: var(--color-text-dim);" class="reveal">
        <h1 class="title-script">Not Found</h1>
        <p style="font-family: var(--font-serif); font-size: 1.2rem; margin-bottom: 40px;">The requested confection is unavailable.</p>
        <a href="{{ route('products.index') }}" class="btn-outline">Return to Collection</a>
    </div>
    @endif

    <!-- Related Products -->
    @if(isset($related) && $related->count())
    <div class="related reveal">
        <h3 class="related-title">Companion Delicacies</h3>
        <div class="related-grid" style="margin-top: 60px;">
            @foreach($related as $index => $rel)
            <a href="{{ route('products.show', $rel->slug) }}" class="product-card reveal" style="text-decoration:none; display:block; transition-delay: {{ ($index % 4) * 0.1 }}s">
                <div style="overflow: hidden; border-radius: 4px;">
                    <img src="{{ $rel->thumbnail ? Storage::url($rel->thumbnail) : 'https://images.unsplash.com/photo-1565958011703-44f9829ba187?q=80&w=500' }}" alt="{{ $rel->name }}" style="width:100%; height:300px; object-fit:cover; display:block;">
                </div>
                <div style="text-align:center; padding-top:20px;">
                    <div style="font-family:var(--font-display); font-size:0.6rem; letter-spacing:0.2em; color:var(--color-text-dim); margin-bottom:5px; text-transform:uppercase;">{{ $rel->category->name ?? '' }}</div>
                    <div style="font-family:var(--font-serif); font-size:1.3rem; color:var(--color-text);">{{ $rel->name }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
function swapImage(thumb) {
    document.getElementById('mainImg').src = thumb.src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}
function selectVar(pill, price) {
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('selected'));
    pill.classList.add('selected');
    if (price) {
        document.getElementById('priceDisplay').innerText = 'AED ' + parseFloat(price).toFixed(0);
    }
}
</script>
@endpush
