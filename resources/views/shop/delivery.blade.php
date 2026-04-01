@extends('layouts.app')

@section('title', 'Delivery Protocols | L\'Atelier')
@section('meta_description', 'Information regarding our luxury delivery logistics and premium handling.')

@push('styles')
<style>
/* Page Header Override */
.page-header {
    background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
}

.delivery-page {
    max-width: 1200px;
    margin: -60px auto 100px;
    padding: 0 40px;
    position: relative;
    z-index: 10;
}

/* Promise Cards */
.promise-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 80px;
}
.promise-card {
    background: rgba(18, 18, 18, 0.8);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    padding: 40px 30px;
    text-align: center;
    transition: transform 0.4s, border-color 0.4s;
}
.promise-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-accent);
}
.promise-icon {
    font-size: 2.5rem;
    color: var(--color-accent);
    margin-bottom: 20px;
}
.promise-title {
    font-family: var(--font-display);
    font-size: 0.9rem; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--color-text);
    margin-bottom: 15px;
}
.promise-desc {
    font-family: var(--font-serif);
    font-size: 1rem; color: var(--color-text-dim); line-height: 1.6;
}

/* Zones Table */
.zones-wrap {
    background: rgba(18, 18, 18, 0.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.05);
    padding: 50px;
    margin-bottom: 80px;
}
.zones-title {
    font-family: var(--font-script);
    font-size: clamp(40px, 6vw, 70px);
    color: var(--color-accent);
    margin-bottom: 40px; text-align: center; font-weight: normal;
}
.zones-table {
    width: 100%; border-collapse: collapse;
}
.zones-table th {
    font-family: var(--font-display);
    font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--color-accent);
    padding: 20px; text-align: left;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.zones-table td {
    font-family: var(--font-serif);
    font-size: 1.1rem; color: var(--color-text);
    padding: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.zones-table tr:hover td { background: rgba(255,255,255,0.02); color: var(--color-accent); }

/* FAQ */
.faq-wrap { max-width: 900px; margin: 0 auto; }
.faq-item {
    border-bottom: 1px solid rgba(255,255,255,0.05);
    margin-bottom: 5px;
}
.faq-q {
    font-family: var(--font-serif);
    font-size: 1.3rem; color: var(--color-text);
    padding: 25px 0; cursor: pointer;
    display: flex; justify-content: space-between; align-items: center;
    transition: color 0.3s;
}
.faq-q:hover { color: var(--color-accent); }
.faq-icon { font-size: 0.8rem; color: var(--color-accent); transition: transform 0.4s; }
.faq-a {
    font-family: var(--font-serif);
    font-size: 1.1rem; color: var(--color-text-dim); line-height: 1.7;
    max-height: 0; overflow: hidden;
    transition: max-height 0.4s ease, padding 0.4s ease;
}
.faq-item.open .faq-a { max-height: 300px; padding-bottom: 25px; }
.faq-item.open .faq-icon { transform: rotate(180deg); }


@media (max-width: 900px) {
    .promise-grid { grid-template-columns: 1fr; }
    .zones-wrap { padding: 30px 15px; overflow-x: auto; }
}
</style>
@endpush

@section('content')

<section class="page-header reveal">
    <div class="page-header-inner">
        <h1 class="section-title-cursive">Logistics</h1>
        <div class="section-subtitle-serif">Premium Delivery Protocols</div>
    </div>
</section>

<div class="delivery-page">
    
    <!-- Promises -->
    <div class="promise-grid">
        <div class="promise-card reveal" style="transition-delay: 0.1s">
            <i class="fa-solid fa-truck-fast promise-icon"></i>
            <div class="promise-title">Chauffeur Delivery</div>
            <div class="promise-desc">Priority handling and direct delivery to your venue, ensuring immaculate condition upon arrival.</div>
        </div>
        <div class="promise-card reveal" style="transition-delay: 0.2s">
            <i class="fa-solid fa-box promise-icon"></i>
            <div class="promise-title">Climate Controlled</div>
            <div class="promise-desc">Artisanal creations are transported in specialized cooling chambers to preserve structural integrity.</div>
        </div>
        <div class="promise-card reveal" style="transition-delay: 0.3s">
            <i class="fa-regular fa-clock promise-icon"></i>
            <div class="promise-title">Precision Timing</div>
            <div class="promise-desc">Scheduled arrival windows tailored exactly to your event's timeline and orchestrations.</div>
        </div>
    </div>

    <!-- Zones Table -->
    <div class="zones-wrap reveal" style="transition-delay: 0.2s">
        <h2 class="zones-title">Zones & Tariffs</h2>
        <table class="zones-table">
            <thead>
                <tr>
                    <th>Territory</th>
                    <th>Transit Time</th>
                    <th>Premium Tariff</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Central District</strong></td>
                    <td>Within 2 Hours</td>
                    <td>Complimentary</td>
                </tr>
                <tr>
                    <td><strong>Zone A (up to 5 km)</strong></td>
                    <td>2–3 Hours</td>
                    <td>AED 10</td>
                </tr>
                <tr>
                    <td><strong>Zone B (up to 10 km)</strong></td>
                    <td>3–4 Hours</td>
                    <td>AED 20</td>
                </tr>
                <tr>
                    <td><strong>Grand Events / Galas</strong></td>
                    <td>Pre-Scheduled</td>
                    <td>Complimentary (Orders > AED 200)</td>
                </tr>
                <tr>
                    <td><strong>Outstation / Provincial</strong></td>
                    <td>By Appointment</td>
                    <td>Consult Concierge</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FAQ -->
    <div class="faq-wrap reveal" style="transition-delay: 0.3s">
        <h2 class="zones-title" style="margin-bottom: 30px;">Inquiries</h2>
        
        <div class="faq-item" id="faq-0">
            <div class="faq-q" onclick="toggleFaq('faq-0')">
                What is the protocol for commissioning a custom piece?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-a">We humbly request a minimum of 3 to 5 days advance notice for grand tier structures or custom sculptures to allow our artisans the necessary time for perfection. Standard collections require 24 hours.</div>
        </div>
        
        <div class="faq-item" id="faq-1">
            <div class="faq-q" onclick="toggleFaq('faq-1')">
                Is provincial or intercity delivery accommodated?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-a">Indeed. We routinely transport our larger architectural cakes to outstation venues. Such arrangements involve dedicated vehicles and, on occasion, an accompanying pastry chef to assemble the structure on-site.</div>
        </div>

        <div class="faq-item" id="faq-2">
            <div class="faq-q" onclick="toggleFaq('faq-2')">
                May I alter the venue after confirming my reservation?
                <i class="fa-solid fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-a">Logistics may be adjusted up to 2 hours prior to the scheduled dispatch by contacting our concierge directly by phone.</div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function toggleFaq(id) {
    const item = document.getElementById(id);
    const isOpen = item.classList.contains('open');
    
    // Close all
    document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('open'));
    
    // Open clicked if it wasn't open
    if(!isOpen) {
        item.classList.add('open');
    }
}
</script>
@endpush
