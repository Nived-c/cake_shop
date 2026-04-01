@extends('layouts.app')
@section('title', 'Delivery Information | Cake Atelier')
@section('meta_description', 'Learn about our delivery zones, charges, and how we ensure your cakes arrive fresh.')

@push('styles')
<style>
.delivery-page { background: var(--white); padding: 80px 0 100px; }
.delivery-inner { max-width: 1280px; margin: 0 auto; padding: 0 32px; }

.delivery-cards {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 32px;
    margin: 56px 0 80px;
}
.delivery-card {
    text-align: center;
    padding: 40px 28px;
    border: 1px solid var(--border);
    border-top: 3px solid var(--teal);
    border-radius: 4px;
    transition: box-shadow 0.3s;
}
.delivery-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.08); }
.delivery-card-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 20px;
    background: rgba(40,106,115,0.08);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: var(--teal);
}
.delivery-card h3 {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 500;
    color: var(--dark);
    margin-bottom: 10px;
}
.delivery-card p { font-size: 14px; color: var(--muted); line-height: 1.75; }

/* Table */
.zones-section { margin-bottom: 80px; }
.zones-table-wrap {
    overflow: hidden;
    border: 1px solid var(--border);
    border-radius: 4px;
    margin-top: 36px;
}
.zones-table { width: 100%; border-collapse: collapse; }
.zones-table thead { background: var(--teal); }
.zones-table th {
    font-family: 'Jost', sans-serif;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: white;
    padding: 16px 20px;
    text-align: left;
}
.zones-table td {
    padding: 14px 20px;
    font-size: 14px;
    color: var(--body);
    border-bottom: 1px solid var(--border);
}
.zones-table tbody tr:last-child td { border-bottom: none; }
.zones-table tbody tr:hover td { background: var(--off-white); }
.badge-available { color: var(--teal); font-weight: 700; font-size: 12px; background: rgba(40,106,115,0.08); padding: 3px 10px; border-radius: 2px; }
.badge-free { color: #e33e4f; font-weight: 700; font-size: 12px; background: rgba(227,62,79,0.08); padding: 3px 10px; border-radius: 2px; }

/* FAQ */
.faq-section { max-width: 800px; }
.faq-item {
    border-bottom: 1px solid var(--border);
}
.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 0;
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 400;
    color: var(--dark);
    cursor: pointer;
    transition: color 0.2s;
}
.faq-question:hover { color: var(--teal); }
.faq-question i { font-size: 13px; color: var(--teal); transition: transform 0.3s; flex-shrink: 0; }
.faq-answer {
    max-height: 0;
    overflow: hidden;
    font-size: 14px;
    color: var(--muted);
    line-height: 1.8;
    transition: max-height 0.4s ease, padding 0.3s;
}
.faq-item.open .faq-answer { max-height: 200px; padding-bottom: 18px; }
.faq-item.open .faq-question { color: var(--teal); }
.faq-item.open .faq-question i { transform: rotate(180deg); }

@media (max-width: 768px) {
    .delivery-cards { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<div class="page-banner">
    <h1>Delivery</h1>
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span>Delivery Info</span>
    </nav>
</div>

<div class="delivery-page">
    <div class="delivery-inner">

        <div>
            <span class="section-label">How We Deliver</span>
            <h2 class="section-heading">Our Delivery Promise</h2>
            <div class="teal-divider"></div>
            <p style="font-size:15px;color:var(--muted);line-height:1.8;max-width:560px;">We take every measure to ensure your cakes arrive fresh, intact, and on time — every single order.</p>
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

        <div class="zones-section">
            <span class="section-label">Coverage Area</span>
            <h2 class="section-heading">Delivery Zones & Charges</h2>
            <div class="teal-divider"></div>
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
                            <td><span class="badge-free">Free Delivery</span></td>
                        </tr>
                        <tr>
                            <td><strong>Zone A (5 km)</strong></td>
                            <td>2–3 hours</td>
                            <td>₹30</td>
                            <td><span class="badge-available">Available</span></td>
                        </tr>
                        <tr>
                            <td><strong>Zone B (10 km)</strong></td>
                            <td>3–4 hours</td>
                            <td>₹60</td>
                            <td><span class="badge-available">Available</span></td>
                        </tr>
                        <tr>
                            <td><strong>Wedding / Events</strong></td>
                            <td>Scheduled</td>
                            <td>Free above ₹2,000</td>
                            <td><span class="badge-free">Free on ₹2000+</span></td>
                        </tr>
                        <tr>
                            <td><strong>Outstation</strong></td>
                            <td>By arrangement</td>
                            <td>As per distance</td>
                            <td><span class="badge-available">Call Us</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="faq-section">
            <span class="section-label">Questions</span>
            <h2 class="section-heading">Frequently Asked Questions</h2>
            <div class="teal-divider"></div>
            @php
                $faqs = [
                    ['q'=>'How early should I place my order?','a'=>'We recommend placing standard orders at least 24 hours in advance. For custom or wedding cakes, a minimum of 3–5 days notice is required.'],
                    ['q'=>'Do you deliver outside the city?','a'=>'Yes, we deliver to outstation locations for special events and weddings. Please call or WhatsApp us to arrange outstation delivery.'],
                    ['q'=>'Can I pick up my order from the store?','a'=>'Absolutely! You can pick up your order directly from our bakery. Just let us know your preferred pickup time when ordering.'],
                    ['q'=>'What if my cake is damaged during delivery?','a'=>'Your satisfaction is our priority. If your cake is damaged on arrival, please photograph it immediately and contact us. We will arrange a replacement or full refund.'],
                    ['q'=>'Can I change my delivery address after placing the order?','a'=>'Yes, you can change the delivery address up to 2 hours before the scheduled delivery time by calling or messaging us on WhatsApp.'],
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
function toggleFaq(id) { document.getElementById(id).classList.toggle('open'); }
</script>
@endpush
