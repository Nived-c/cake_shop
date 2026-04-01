@extends('layouts.app')

@section('title', 'Customized Cakes | Cake Atelier')
@section('meta_description', 'Order custom designed cakes for weddings, birthdays and all occasions. Tell us your requirements and we will craft your dream cake.')

@push('styles')
<style>
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
    background: radial-gradient(ellipse at center, rgba(189,150,46,0.12) 0%, transparent 70%);
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
.page-hero p { color: rgba(255,255,255,0.75); font-size: 16px; position: relative; z-index: 2; }
.breadcrumb { position: relative; z-index: 2; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 16px; }
.breadcrumb a { color: var(--gold); }

.drip-down { background: var(--maroon); line-height: 0; }
.drip-down svg { width: 100%; height: 70px; display: block; }

/* ===== CUSTOMIZED PAGE ===== */
.customized-page { background: var(--cream); padding: 80px 0; }
.customized-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Process Steps */
.steps-section { margin-bottom: 80px; }
.steps-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    position: relative;
    margin-top: 48px;
}
.steps-grid::before {
    content: '';
    position: absolute;
    top: 36px;
    left: 10%;
    right: 10%;
    height: 2px;
    background: linear-gradient(90deg, var(--gold) 0%, var(--maroon) 100%);
    z-index: 0;
}
.step-card {
    background: white;
    border-radius: 14px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(101,6,50,0.08);
    position: relative;
    z-index: 1;
    transition: transform 0.3s, box-shadow 0.3s;
}
.step-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(101,6,50,0.15);
}
.step-number {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--maroon);
    color: white;
    font-family: 'Signika', sans-serif;
    font-size: 22px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    box-shadow: 0 6px 18px rgba(101,6,50,0.3);
}
.step-card h4 {
    font-family: 'Signika', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 8px;
}
.step-card p { font-size: 13px; color: var(--text-mid); line-height: 1.7; }

/* Order Form */
.order-form-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}
.form-info h2 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(24px, 3.5vw, 34px);
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}
.form-info h2 span { color: var(--maroon); }
.form-info p { font-size: 15px; color: var(--text-mid); line-height: 1.8; margin-bottom: 24px; }
.gallery-mini {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.gallery-mini img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(101,6,50,0.12);
    transition: transform 0.3s;
}
.gallery-mini img:hover { transform: scale(1.03); }

.custom-form { background: white; border-radius: 14px; padding: 36px; box-shadow: 0 4px 20px rgba(101,6,50,0.1); }
.form-group { margin-bottom: 20px; }
.form-label {
    display: block;
    font-family: 'Signika', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: var(--maroon);
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    padding: 11px 14px;
    border: 2px solid var(--cream-dark);
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-dark);
    background: var(--cream);
    font-family: 'Open Sans', sans-serif;
    outline: none;
    transition: border-color 0.2s, background 0.2s;
}
.form-control:focus { border-color: var(--maroon); background: white; }
textarea.form-control { resize: vertical; min-height: 110px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

@media (max-width: 900px) {
    .steps-grid { grid-template-columns: 1fr 1fr; }
    .steps-grid::before { display: none; }
    .order-form-section { grid-template-columns: 1fr; }
}
@media (max-width: 500px) {
    .steps-grid { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> &rsaquo; Customized Cakes</div>
    <h1>Customized Cakes</h1>
    <p>Your dream cake, crafted with love and expertise</p>
</section>

<div class="drip-down">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 L0,30 Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38 Q350,65 390,35 Q430,5 470,35 Q510,65 550,38 Q590,10 630,38 Q670,66 710,38 Q750,10 790,35 Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38 Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35 Q1310,60 1350,38 Q1390,15 1440,35 L1440,0 Z" fill="var(--cream)"/>
    </svg>
</div>

<div class="customized-page">
    <div class="customized-inner">

        <!-- How It Works -->
        <div class="steps-section">
            <p class="section-title">How It Works</p>
            <div class="section-underline"></div>
            <p class="section-subtitle">Ordering your custom cake is simple. Follow these 4 easy steps and we'll handle the rest.</p>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <h4>Fill the Form</h4>
                    <p>Tell us your cake details — size, flavour, design concept and occasion.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">02</div>
                    <h4>Get a Quote</h4>
                    <p>We'll contact you within 24 hours with a personalised price quote.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">03</div>
                    <h4>Confirm & Pay</h4>
                    <p>Approve the design, pay a 50% advance and relax while we bake.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">04</div>
                    <h4>Delivery</h4>
                    <p>Your masterpiece is freshly baked and delivered right to your door.</p>
                </div>
            </div>
        </div>

        <!-- Order Form + Gallery -->
        <div class="order-form-section">
            <div class="form-info">
                <h2>Tell us about your<br><span>dream cake</span></h2>
                <div class="section-underline" style="margin:16px 0 20px;"></div>
                <p>We craft cakes for every occasion — birthdays, weddings, engagements, baby showers and more. Our expert bakers will bring your vision to life using only the finest ingredients.</p>
                <p>For urgent orders or quick queries, <a href="https://wa.me/919895588988" style="color:var(--maroon);font-weight:700;">message us on WhatsApp</a>.</p>
                <div class="gallery-mini">
                    <img src="https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=400&auto=format&fit=crop" alt="Custom wedding cake">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=400&auto=format&fit=crop" alt="Custom birthday cake">
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=400&auto=format&fit=crop" alt="Elegant cake">
                    <img src="https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=400&auto=format&fit=crop" alt="Decorated cake">
                </div>
            </div>

            <!-- Form -->
            <div class="custom-form">
                <h3 style="font-family:'Signika',sans-serif;font-size:20px;font-weight:700;color:var(--maroon);margin-bottom:24px;">Custom Cake Request</h3>
                <form action="#" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="full_name">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+91 XXXXX XXXXX" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="occasion">Occasion *</label>
                            <select id="occasion" name="occasion" class="form-control" required>
                                <option value="">Select occasion</option>
                                <option>Birthday</option>
                                <option>Wedding</option>
                                <option>Engagement</option>
                                <option>Baby Shower</option>
                                <option>Anniversary</option>
                                <option>Corporate Event</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="delivery_date">Delivery Date *</label>
                            <input type="date" id="delivery_date" name="delivery_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="cake_size">Cake Size *</label>
                            <select id="cake_size" name="cake_size" class="form-control" required>
                                <option value="">Select size</option>
                                <option>0.5 kg</option>
                                <option>1 kg</option>
                                <option>1.5 kg</option>
                                <option>2 kg</option>
                                <option>3 kg</option>
                                <option>Custom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="flavour">Cake Flavour *</label>
                            <select id="flavour" name="flavour" class="form-control" required>
                                <option value="">Select flavour</option>
                                <option>Chocolate</option>
                                <option>Vanilla</option>
                                <option>Red Velvet</option>
                                <option>Black Forest</option>
                                <option>Butterscotch</option>
                                <option>Strawberry</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="design_details">Design Details &amp; Special Instructions *</label>
                        <textarea id="design_details" name="design_details" class="form-control" placeholder="Describe your cake design, theme, colours, message to write, any reference images..." required></textarea>
                    </div>
                    <button type="submit" class="btn-maroon" style="width:100%;font-size:15px;padding:14px;">
                        <i class="fa-solid fa-paper-plane"></i>&nbsp; Submit Request
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
