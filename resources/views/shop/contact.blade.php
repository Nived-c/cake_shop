@extends('layouts.app')

@section('title', 'Contact Us | Cake Atelier')
@section('meta_description', 'Get in touch with Cake Atelier. Find our address, phone numbers, email and opening hours. We love to hear from our customers.')

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
.breadcrumb { position:relative;z-index:2;font-size:13px;color:rgba(255,255,255,0.6);margin-bottom:16px; }
.breadcrumb a { color: var(--gold); }
.drip-down { background: var(--maroon); line-height: 0; }
.drip-down svg { width: 100%; height: 70px; display: block; }

/* ===== CONTACT PAGE ===== */
.contact-page { background: var(--cream); padding: 80px 0; }
.contact-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 56px;
    align-items: start;
}

/* Contact Details */
.contact-info h2 {
    font-family: 'Signika', sans-serif;
    font-size: clamp(24px, 3.5vw, 34px);
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 8px;
}
.contact-info h2 span { color: var(--maroon); }
.contact-info > p {
    font-size: 15px;
    color: var(--text-mid);
    line-height: 1.8;
    margin-bottom: 32px;
}

.contact-detail-cards { display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; }
.contact-detail-card {
    background: white;
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    box-shadow: 0 4px 16px rgba(101,6,50,0.08);
    transition: transform 0.25s, box-shadow 0.25s;
}
.contact-detail-card:hover {
    transform: translateX(4px);
    box-shadow: 0 8px 28px rgba(101,6,50,0.14);
}
.contact-detail-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--maroon);
    color: white;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.contact-detail-card .label {
    font-family: 'Signika', sans-serif;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--gold);
    margin-bottom: 4px;
}
.contact-detail-card h4 {
    font-family: 'Signika', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}
.contact-detail-card p, .contact-detail-card a {
    font-size: 14px;
    color: var(--text-mid);
    line-height: 1.7;
}
.contact-detail-card a:hover { color: var(--maroon); }

/* Hours */
.hours-table { width: 100%; border-collapse: collapse; }
.hours-table tr td {
    padding: 8px 12px;
    font-size: 14px;
    color: var(--text-mid);
    border-bottom: 1px solid var(--cream-dark);
}
.hours-table tr:last-child td { border-bottom: none; }
.hours-table tr td:first-child { font-weight: 600; color: var(--text-dark); }
.hours-table tr td:last-child { text-align: right; }
.open-badge { color: #22c55e; font-weight: 700; }
.closed-badge { color: #ef4444; font-weight: 700; }

/* Contact Form */
.contact-form-wrap {
    background: white;
    border-radius: 14px;
    padding: 40px 36px;
    box-shadow: 0 4px 20px rgba(101,6,50,0.1);
}
.contact-form-wrap h3 {
    font-family: 'Signika', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--maroon);
    margin-bottom: 24px;
}
.form-group { margin-bottom: 20px; }
.form-label { display:block;font-family:'Signika',sans-serif;font-size:14px;font-weight:600;color:var(--maroon);margin-bottom:6px; }
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
textarea.form-control { resize: vertical; min-height: 120px; }

/* Map */
.map-section {
    background: var(--maroon);
    padding: 0;
    margin-top: 80px;
}
.map-section iframe {
    width: 100%;
    height: 380px;
    border: 0;
    display: block;
    filter: sepia(0.3) contrast(1.1);
}

/* Alert */
.alert-success {
    background: rgba(34,197,94,0.1);
    border: 2px solid rgba(34,197,94,0.3);
    color: #15803d;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

@media (max-width: 900px) {
    .contact-inner { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="page-hero">
    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> &rsaquo; Contact Us</div>
    <h1>Contact Us</h1>
    <p>We'd love to hear from you — reach out any time</p>
</section>

<div class="drip-down">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 L0,30 Q30,70 70,30 Q110,0 150,30 Q190,60 230,35 Q270,10 310,38 Q350,65 390,35 Q430,5 470,35 Q510,65 550,38 Q590,10 630,38 Q670,66 710,38 Q750,10 790,35 Q830,60 870,35 Q910,10 950,35 Q990,60 1030,38 Q1070,15 1110,40 Q1150,65 1190,38 Q1230,10 1270,35 Q1310,60 1350,38 Q1390,15 1440,35 L1440,0 Z" fill="var(--cream)"/>
    </svg>
</div>

<div class="contact-page">
    <div class="contact-inner">

        <!-- Left: Info -->
        <div class="contact-info">
            <h2>Get in <span>Touch</span></h2>
            <div class="section-underline" style="margin:14px 0 20px;"></div>
            <p>
                We're always happy to assist you — whether you'd like information about our products, want to place a custom order, or simply want to say hello. Drop by our bakery or reach out via phone, email or WhatsApp.
            </p>

            <div class="contact-detail-cards">
                <div class="contact-detail-card">
                    <div class="contact-detail-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div class="label">Our Location</div>
                        <h4>Cake Atelier</h4>
                        <p>123 Baker's Lane, MG Road<br>Kochi, Kerala – 682001</p>
                    </div>
                </div>
                <div class="contact-detail-card">
                    <div class="contact-detail-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <div class="label">Call Us</div>
                        <h4>Phone Numbers</h4>
                        <p>
                            <a href="tel:+914842767660">Tel: 0484 2767660</a><br>
                            <a href="tel:+919895588988">Mob: +91 98955 88988</a>
                        </p>
                    </div>
                </div>
                <div class="contact-detail-card">
                    <div class="contact-detail-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div class="label">Email Us</div>
                        <h4>Email Address</h4>
                        <a href="mailto:hello@cakeatelier.in">hello@cakeatelier.in</a>
                    </div>
                </div>
                <div class="contact-detail-card">
                    <div class="contact-detail-icon"><i class="fa-brands fa-whatsapp"></i></div>
                    <div>
                        <div class="label">WhatsApp Orders</div>
                        <h4>Chat with Us</h4>
                        <a href="https://wa.me/919895588988" target="_blank">+91 98955 88988</a>
                    </div>
                </div>
            </div>

            <!-- Hours -->
            <div style="background:white;border-radius:12px;padding:24px;box-shadow:0 4px 16px rgba(101,6,50,0.08);">
                <h4 style="font-family:'Signika',sans-serif;font-size:17px;font-weight:700;color:var(--maroon);margin-bottom:16px;">
                    <i class="fa-solid fa-clock" style="color:var(--gold);margin-right:8px;"></i>Opening Hours
                </h4>
                <table class="hours-table">
                    <tr><td>Monday – Friday</td><td class="open-badge">8:00 AM – 9:00 PM</td></tr>
                    <tr><td>Saturday</td><td class="open-badge">8:00 AM – 10:00 PM</td></tr>
                    <tr><td>Sunday</td><td class="open-badge">9:00 AM – 8:00 PM</td></tr>
                    <tr><td>Public Holidays</td><td class="open-badge">10:00 AM – 6:00 PM</td></tr>
                </table>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="contact-form-wrap">
            <h3><i class="fa-solid fa-paper-plane" style="color:var(--gold);margin-right:10px;"></i>Send Us a Message</h3>

            @if(session('success'))
                <div class="alert-success">✅ {{ session('success') }}</div>
            @endif

            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="contact_name">Full Name *</label>
                    <input type="text" id="contact_name" name="name" class="form-control" placeholder="Your full name" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="contact_email">Email Address *</label>
                    <input type="email" id="contact_email" name="email" class="form-control" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="contact_phone">Phone Number</label>
                    <input type="tel" id="contact_phone" name="phone" class="form-control" placeholder="+91 XXXXX XXXXX">
                </div>
                <div class="form-group">
                    <label class="form-label" for="contact_subject">Subject *</label>
                    <select id="contact_subject" name="subject" class="form-control" required>
                        <option value="">Select a subject</option>
                        <option>General Inquiry</option>
                        <option>Custom Cake Order</option>
                        <option>Delivery Query</option>
                        <option>Feedback / Complaint</option>
                        <option>Partnerships</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="contact_message">Message *</label>
                    <textarea id="contact_message" name="message" class="form-control" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn-maroon" style="width:100%;font-size:15px;padding:14px;">
                    <i class="fa-solid fa-paper-plane"></i>&nbsp; Send Message
                </button>
            </form>
        </div>

    </div>
</div>

<!-- Map -->
<div class="map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.376853434!2d76.2673!3d9.9312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTUnNTIuMyJOIDc2wrAxNic0Mi4zIkU!5e0!3m2!1sen!2sin!4v1600000000"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="Cake Atelier Location Map"
    ></iframe>
</div>

@endsection
