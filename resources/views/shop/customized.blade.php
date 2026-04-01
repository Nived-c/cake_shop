@extends('layouts.app')
@section('title', 'Customized Cakes | Cake Atelier')
@section('meta_description', 'Order custom designed cakes for weddings, birthdays and all occasions.')

@push('styles')
<style>
.customized-page { background: var(--white); padding: 80px 0 100px; }
.customized-inner { max-width: 1280px; margin: 0 auto; padding: 0 32px; }

/* Steps */
.steps-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    position: relative;
    margin: 56px 0 80px;
}
.steps-row::before {
    content: '';
    position: absolute;
    top: 28px;
    left: 15%;
    right: 15%;
    height: 1px;
    background: var(--border);
}
.step-card { text-align: center; position: relative; }
.step-num {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: var(--teal);
    color: white;
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 400;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.step-card h4 {
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 500;
    color: var(--dark);
    margin-bottom: 8px;
}
.step-card p { font-size: 13px; color: var(--muted); line-height: 1.7; }

/* Order section */
.order-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}
.gallery-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 28px;
}
.gallery-grid img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    border-radius: 4px;
    filter: grayscale(10%);
    transition: filter 0.3s, transform 0.3s;
}
.gallery-grid img:hover { filter: grayscale(0); transform: scale(1.02); }

/* Form */
.order-form {
    background: var(--off-white);
    border-radius: 4px;
    padding: 40px;
    border-top: 3px solid var(--teal);
}
.order-form h3 {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 400;
    color: var(--dark);
    margin-bottom: 28px;
}
.form-group { margin-bottom: 18px; }
.form-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    padding: 11px 14px;
    border: 1px solid var(--border);
    border-radius: 4px;
    font-size: 14px;
    font-family: 'Jost', sans-serif;
    color: var(--dark);
    background: var(--white);
    outline: none;
    transition: border-color 0.2s;
}
.form-control:focus { border-color: var(--teal); }
textarea.form-control { min-height: 110px; resize: vertical; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

@media (max-width: 900px) {
    .steps-row { grid-template-columns: repeat(2,1fr); }
    .steps-row::before { display: none; }
    .order-section { grid-template-columns: 1fr; gap: 40px; }
    .order-form { padding: 28px; }
}
@media (max-width: 480px) {
    .steps-row { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="page-banner">
    <h1>Customized Cakes</h1>
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span>Customized Cakes</span>
    </nav>
</div>

<div class="customized-page">
    <div class="customized-inner">

        <!-- Intro -->
        <div style="max-width:640px;">
            <span class="section-label">Made For You</span>
            <h2 class="section-heading">Your dream cake, crafted to perfection</h2>
            <div class="teal-divider"></div>
            <p style="font-size:15px;color:var(--muted);line-height:1.8;">We craft cakes for every occasion — birthdays, weddings, engagements, baby showers and more. Our expert bakers will bring your vision to life using only the finest ingredients.</p>
        </div>

        <!-- Steps -->
        <div class="steps-row">
            <div class="step-card">
                <div class="step-num">01</div>
                <h4>Fill the Form</h4>
                <p>Tell us your cake details — size, flavour, design concept and occasion.</p>
            </div>
            <div class="step-card">
                <div class="step-num">02</div>
                <h4>Get a Quote</h4>
                <p>We'll contact you within 24 hours with a personalised price quote.</p>
            </div>
            <div class="step-card">
                <div class="step-num">03</div>
                <h4>Confirm & Pay</h4>
                <p>Approve the design, pay a 50% advance and relax while we bake.</p>
            </div>
            <div class="step-card">
                <div class="step-num">04</div>
                <h4>Delivery</h4>
                <p>Your masterpiece is freshly baked and delivered right to your door.</p>
            </div>
        </div>

        <!-- Order form + gallery -->
        <div class="order-section">
            <div>
                <span class="section-label">Inspiration Gallery</span>
                <h2 class="section-heading">What we can create for you</h2>
                <div class="teal-divider"></div>
                <p style="font-size:15px;color:var(--muted);line-height:1.8;margin-bottom:8px;">
                    From elegant wedding cakes to fun birthday creations — every cake we make is a unique work of art.
                    For urgent queries, <a href="https://wa.me/919895588988" style="color:var(--teal);font-weight:600;">message us on WhatsApp</a>.
                </p>
                <div class="gallery-grid">
                    <img src="https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=400" alt="Wedding cake">
                    <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?q=80&w=400" alt="Birthday cake">
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=400" alt="Elegant cake">
                    <img src="https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=400" alt="Decorated cake">
                </div>
            </div>

            <div class="order-form">
                <h3>Custom Cake Request</h3>
                <form action="#" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="full_name">Full Name *</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone *</label>
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
                                <option value="">Select...</option>
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
                                <option value="">Select...</option>
                                <option>0.5 kg</option><option>1 kg</option><option>1.5 kg</option>
                                <option>2 kg</option><option>3 kg</option><option>Custom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="flavour">Flavour *</label>
                            <select id="flavour" name="flavour" class="form-control" required>
                                <option value="">Select...</option>
                                <option>Chocolate</option><option>Vanilla</option><option>Red Velvet</option>
                                <option>Black Forest</option><option>Butterscotch</option><option>Strawberry</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="design_details">Design Details & Instructions *</label>
                        <textarea id="design_details" name="design_details" class="form-control" placeholder="Describe your cake design, theme, colours, message to write..." required></textarea>
                    </div>
                    <button type="submit" class="btn-teal" style="width:100%;justify-content:center;font-size:14px;padding:14px;">
                        <i class="fa-solid fa-paper-plane"></i> Submit Request
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
