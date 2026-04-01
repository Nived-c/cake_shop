@extends('layouts.app')

@section('title', 'Custom Cakes Orders | L\'Atelier')
@section('meta_description', 'Commission a custom masterpiece tailored uniquely for your grand celebrations and events.')

@push('styles')
<style>
/* Page Header Override */
.page-header {
    background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
}

.customized-page {
    max-width: 1400px;
    margin: -60px auto 100px;
    padding: 0 40px;
    position: relative;
    z-index: 10;
}

/* Process Steps */
.process-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    margin-bottom: 100px;
}
.process-step {
    background: rgba(18, 18, 18, 0.8);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    padding: 40px 30px;
    text-align: center;
    transition: transform 0.4s, border-color 0.4s;
}
.process-step:hover {
    transform: translateY(-10px);
    border-color: var(--color-accent);
}
.step-num {
    font-family: var(--font-display);
    font-size: 2rem;
    color: var(--color-accent);
    margin-bottom: 20px;
}
.step-title {
    font-family: var(--font-display);
    font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--color-text);
    margin-bottom: 15px;
}
.step-desc {
    font-family: var(--font-serif);
    font-size: 1rem; color: var(--color-text-dim);
}

/* Form Area */
.custom-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 80px;
    align-items: start;
}
.custom-info h2 {
    font-family: var(--font-script);
    font-size: clamp(50px, 8vw, 100px);
    line-height: 0.8; color: var(--color-accent);
    margin-bottom: 30px; font-weight: normal;
}
.custom-info p {
    font-family: var(--font-serif);
    font-size: 1.2rem; line-height: 1.8; color: var(--color-text-dim);
    margin-bottom: 40px;
}
.gallery-mini {
    display: grid; grid-template-columns: 1fr 1fr; gap: 15px;
}
.gallery-mini img {
    width: 100%; height: 250px; object-fit: cover;
    filter: brightness(0.7) contrast(1.1);
    transition: filter 0.4s; border-radius: 2px;
}
.gallery-mini img:hover { filter: brightness(1) contrast(1.1); }

/* Form Styles */
.custom-form-container {
    background: rgba(18, 18, 18, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    padding: 50px;
}
.form-title {
    font-family: var(--font-display);
    font-size: 1.2rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--color-text); margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 20px;
}
.form-group { margin-bottom: 25px; }
.form-label {
    display: block; font-family: var(--font-display); font-size: 0.7rem;
    letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent);
    margin-bottom: 10px;
}
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

@media (max-width: 900px) {
    .process-grid { grid-template-columns: 1fr 1fr; }
    .custom-grid { grid-template-columns: 1fr; }
    .custom-form-container { padding: 30px 20px; }
}
@media (max-width: 600px) {
    .process-grid { grid-template-columns: 1fr; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="page-header reveal">
    <div class="page-header-inner">
        <h1 class="section-title-cursive">Custom Cakes</h1>
        <div class="section-subtitle-serif">Sculpted Masterpieces</div>
    </div>
</section>

<div class="customized-page">
    
    <!-- Process -->
    <div class="process-grid">
        <div class="process-step reveal" style="transition-delay: 0.1s">
            <div class="step-num">01</div>
            <div class="step-title">The Vision</div>
            <div class="step-desc">Share your aesthetic desires, occasion, and scaling requirements.</div>
        </div>
        <div class="process-step reveal" style="transition-delay: 0.2s">
            <div class="step-num">02</div>
            <div class="step-title">The Proposal</div>
            <div class="step-desc">Receive a personalized consultation and tailored artisanal quote.</div>
        </div>
        <div class="process-step reveal" style="transition-delay: 0.3s">
            <div class="step-num">03</div>
            <div class="step-title">The Agreement</div>
            <div class="step-desc">Approve the concept mapping and secure your reservation.</div>
        </div>
        <div class="process-step reveal" style="transition-delay: 0.4s">
            <div class="step-num">04</div>
            <div class="step-title">The Reveal</div>
            <div class="step-desc">Experience the masterpiece, crafted and delivered flawlessly.</div>
        </div>
    </div>

    <!-- Form Area -->
    <div class="custom-grid">
        <div class="custom-info reveal">
            <h2>The Art of <br>Celebration</h2>
            <p>We transform your grandest occasions into edible art. From monumental wedding tiers to intimate anniversary celebrations, our master pastry chefs blend classical European techniques with visionary design to create something truly unprecedented.</p>
            <p style="margin-bottom: 40px;">For immediate concierge service, <a href="https://wa.me/000000" style="color:var(--color-accent);">connect via WhatsApp</a>.</p>
            
            <div class="gallery-mini">
                <img src="https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=400&auto=format&fit=crop" alt="Custom Cakes Cake">
                <img src="https://images.unsplash.com/photo-1535141192574-5d4897c12636?q=80&w=400&auto=format&fit=crop" alt="Elegant Tiered Cake">
            </div>
        </div>

        <div class="custom-form-container reveal" style="transition-delay: 0.2s">
            <h3 class="form-title">Submit an Inquiry</h3>
            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="full_name">Client Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="E.g. James Smith" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">Contact Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+971" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Electronic Mail</label>
                    <input type="email" id="email" name="email" placeholder="client@address.ae">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="occasion">Event Type</label>
                        <select id="occasion" name="occasion" required>
                            <option value="">Select Event</option>
                            <option>Wedding Gala</option>
                            <option>Birthday Celebration</option>
                            <option>Corporate Banquet</option>
                            <option>Anniversary</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delivery_date">Required Date</label>
                        <input type="date" id="delivery_date" name="delivery_date" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="cake_size">Scale / Tiers</label>
                        <select id="cake_size" name="cake_size" required>
                            <option value="">Select Scale</option>
                            <option>Single Tier (1-2 kg)</option>
                            <option>Two Tiers (3-5 kg)</option>
                            <option>Grand Multi-Tier</option>
                            <option>Custom Dimension</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="flavour">Base Profile</label>
                        <select id="flavour" name="flavour" required>
                            <option value="">Select Profile</option>
                            <option>Noir Chocolate Velvet</option>
                            <option>Madagascar Vanilla</option>
                            <option>Red Velvet & Cream Cheese</option>
                            <option>Truffle Infusion</option>
                            <option>Custom Mix</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="design_details">Artistic Direction & Details</label>
                    <textarea id="design_details" name="design_details" rows="5" placeholder="Describe the aesthetic, colors, themes, or architectural details you envision..." required></textarea>
                </div>
                
                <button type="submit" class="btn-solid" style="width:100%;">Submit Inquiry</button>
            </form>
        </div>
    </div>
</div>

@endsection
