@extends('layouts.app')

@section('title', 'Delivery Information | Cake Atelier')
@section('meta_description', 'Learn about our cake delivery zones, delivery times, and how we ensure your cakes arrive fresh and perfect every time.')

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

/* ===== DELIVERY PAGE ===== */
.delivery-page { background: var(--cream); padding: 80px 0; }

/* Info Cards */
.delivery-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    max-width: 1100px;
    margin: 48px auto 72px;
    padding: 0 24px;
}
.delivery-card {
    background: white;
    border-radius: 14px;
    padding: 36px 28px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(101,6,50,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}
.delivery-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(101,6,50,0.14);
}
.delivery-card-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--maroon) 0%, var(--maroon-light) 100%);
    color: white;
    font-size: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 8px 20px rgba(101,6,50,0.25);
}
.delivery-card h3 {
    font-family: 'Signika', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 10px;
}
.delivery-card p { font-size: 14px; color: var(--text-mid); line-height: 1.75; }

/* Zones Table */
.zones-section {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px 72px;
}
.zones-table-wrap {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(101,6,50,0.08);
    margin-top: 40px;
}
.zones-table {
    width: 100%;
    border-collapse: collapse;
}
.zones-table thead {
    background: var(--maroon);
    color: white;
}
.zones-table th {
    font-family: 'Signika', sans-serif;
    font-size: 14px;
    font-weight: 600;
    padding: 16px 20px;
    text-align: left;
    letter-spacing: 0.03em;
}
.zones-table td {
    padding: 14px 20px;
    font-size: 14px;
    color: var(--text-mid);
    border-bottom: 1px solid var(--cream-dark);
}
.zones-table tbody tr:last-child td { border-bottom: none; }
.zones-table tbody tr:hover td { background: var(--cream); }
.status-badge {
    display: inline-block;
    padding: 3px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    font-family: 'Signika', sans-serif;
}
.badge-available { background: rgba(101,6,50,0.1); color: var(--maroon); }
.badge-free { background: rgba(189,150,46,0.15); color: var(--gold); }

/* FAQ */
.faq-section {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px 80px;
}
.faq-item {
    background: white;
    border-radius: 10px;
    margin-bottom: 12px;
    box-shadow: 0 2px 10px rgba(101,6,50,0.06);
    overflow: hidden;
}
.faq-question {
    padding: 18px 24px;
    font-family: 'Signika', sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: var(--text-dark);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: color 0.2s;
}
.faq-question:hover { color: var(--maroon); }
.faq-question i { color: var(--gold); transition: transform 0.3s; font-size: 14px; }
.faq-answer {
    padding: 0 24px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.8;
}
.faq-item.open .faq-answer { max-height: 200px; padding: 0 24px 20px; }
.faq-item.open .faq-question i { transform: rotate(180deg); }
.faq-item.open .faq-question { color: var(--maroon); }

@media (max-width: 768px) {
    .delivery-cards { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> &rsaquo; Delivery</div>
    <h1>Delivery Information</h1>
    <p>Fresh cakes delivered with care right to your doorstep</p>
</section>

<div class="drip-down">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 L0,30 Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38 Q350,65 390,35 Q430,5 470,35 Q510,65 550,38 Q590,10 630,38 Q670,66 710,38 Q750,10 790,35 Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38 Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35 Q1310,60 1350,38 Q1390,15 1440,35 L1440,0 Z" fill="var(--cream)"/>
    </svg>
</div>

<div class="delivery-page">
    <!-- Delivery Info Cards -->
    <div class="container">
        <p class="section-title">Our Delivery Promise</p>
        <div class="section-underline"></div>
        <p class="section-subtitle">We take every measure to ensure your cakes arrive fresh, intact, and on time — every single order.</p>
    </div>

    <div class="delivery-cards">
        <div class="delivery-card">
            <div class="delivery-card-icon"><i class="fa-solid fa-truck-fast"></i></div>
            <h3>Same-Day Delivery</h3>
            <p>Place your order before 10 AM for same-day delivery within our primary delivery zones. Fresh from our oven to your door.</p>
        </div>
        <div class="delivery-card">
            <div class="delivery-card-icon"><i class="fa-solid fa-box-heart"></i></div>
            <h3>Safe Packaging</h3>
            <p>All our cakes are packed in temperature-controlled, shock-resistant boxes to ensure they arrive in perfect condition.</p>
        </div>
        <div class="delivery-card">
            <div class="delivery-card-icon"><i class="fa-solid fa-clock"></i></div>
            <h3>Advance Booking</h3>
            <p>For custom and occasion cakes, we recommend placing your order at least 24–48 hours in advance to guarantee availability.</p>
        </div>
    </div>

    <!-- Delivery Zones Table -->
    <div class="zones-section">
        <p class="section-title">Delivery Zones & Charges</p>
        <div class="section-underline"></div>
        <p class="section-subtitle">We deliver across the city and surrounding areas. Check if we deliver to your location below.</p>

        <div class="zones-table-wrap">
            <table class="zones-table">
                <thead>
                    <tr>
                        <th>Zone / Area</th>
                        <th>Delivery Time</th>
                        <th>Delivery Charge</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>City Centre</strong></td>
                        <td>Within 2 hours</td>
                        <td>Free</td>
                        <td><span class="status-badge badge-free">Free Delivery</span></td>
                    </tr>
                    <tr>
                        <td><strong>Zone A (5 km)</strong></td>
                        <td>2–3 hours</td>
                        <td>₹30</td>
                        <td><span class="status-badge badge-available">Available</span></td>
                    </tr>
                    <tr>
                        <td><strong>Zone B (10 km)</strong></td>
                        <td>3–4 hours</td>
                        <td>₹60</td>
                        <td><span class="status-badge badge-available">Available</span></td>
                    </tr>
                    <tr>
                        <td><strong>Wedding / Events</strong></td>
                        <td>Scheduled</td>
                        <td>Free above ₹2,000</td>
                        <td><span class="status-badge badge-free">Free on Orders ₹2000+</span></td>
                    </tr>
                    <tr>
                        <td><strong>Outstation</strong></td>
                        <td>By arrangement</td>
                        <td>As per distance</td>
                        <td><span class="status-badge badge-available">Call us</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- FAQ -->
    <div class="faq-section">
        <p class="section-title">Frequently Asked Questions</p>
        <div class="section-underline"></div>

        <div style="margin-top:36px;">
            @php
                $faqs = [
                    ['q' => 'How early should I place my order?', 'a' => 'We recommend placing standard orders at least 24 hours in advance. For custom or wedding cakes, a minimum of 3–5 days notice is required.'],
                    ['q' => 'Do you deliver outside the city?', 'a' => 'Yes, we deliver to outstation locations for special events and weddings. Please call or WhatsApp us to arrange outstation delivery.'],
                    ['q' => 'Can I pick up my order from the store?', 'a' => 'Absolutely! You can pick up your order directly from our bakery. Just let us know your preferred pickup time when ordering.'],
                    ['q' => 'What if my cake is damaged during delivery?', 'a' => 'Your satisfaction is our priority. If your cake is damaged on arrival, please photograph it immediately and contact us. We will arrange a replacement or full refund.'],
                    ['q' => 'Can I change my delivery address after placing the order?', 'a' => 'Yes, you can change the delivery address up to 2 hours before the scheduled delivery time by calling or messaging us on WhatsApp.'],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="faq-item" id="faq-{{ $i }}">
                <div class="faq-question" onclick="toggleFaq('faq-{{ $i }}')">
                    {{ $faq['q'] }}
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-answer">{{ $faq['a'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleFaq(id) {
    const item = document.getElementById(id);
    item.classList.toggle('open');
}
</script>
@endpush
