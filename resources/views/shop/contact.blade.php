@extends('layouts.app')
@section('title', 'Contact Us | Cake Atelier')
@section('meta_description', 'Get in touch with Cake Atelier. Find our address, phone, email and opening hours.')

@push('styles')
<style>
.contact-page { background: var(--white); padding: 80px 0 100px; }
.contact-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}

/* Info */
.contact-details { display: flex; flex-direction: column; gap: 28px; margin: 36px 0; }
.contact-item { display: flex; gap: 20px; align-items: flex-start; }
.contact-item-icon {
    width: 48px;
    height: 48px;
    background: rgba(40,106,115,0.08);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: var(--teal);
    flex-shrink: 0;
}
.contact-item-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 4px;
}
.contact-item h4 {
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 400;
    color: var(--dark);
    margin-bottom: 3px;
}
.contact-item p, .contact-item a { font-size: 14px; color: var(--muted); line-height: 1.7; }
.contact-item a:hover { color: var(--teal); }

/* Hours */
.hours-table { width: 100%; border-collapse: collapse; margin-top: 36px; }
.hours-table tr td {
    padding: 10px 0;
    font-size: 14px;
    color: var(--muted);
    border-bottom: 1px solid var(--border);
}
.hours-table tr:last-child td { border-bottom: none; }
.hours-table tr td:first-child { color: var(--dark); font-weight: 500; }
.hours-table tr td:last-child { text-align: right; color: var(--teal); font-weight: 600; }

/* Form */
.contact-form-wrap {
    background: var(--off-white);
    padding: 44px;
    border-top: 3px solid var(--teal);
    border-radius: 4px;
}
.contact-form-wrap h3 {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    font-weight: 400;
    color: var(--dark);
    margin-bottom: 28px;
}
.form-group { margin-bottom: 18px; }
.form-label { display:block;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:var(--muted);margin-bottom:6px; }
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
textarea.form-control { min-height: 120px; resize: vertical; }
.alert-success {
    background: rgba(40,106,115,0.08);
    border: 1px solid rgba(40,106,115,0.2);
    color: var(--teal);
    padding: 12px 16px;
    border-radius: 4px;
    font-size: 14px;
    margin-bottom: 20px;
}

/* Map */
.map-wrap { margin-top: 80px; }
.map-wrap iframe { width: 100%; height: 360px; border: 0; display: block; border-radius: 4px; }

@media (max-width: 900px) {
    .contact-inner { grid-template-columns: 1fr; }
    .contact-form-wrap { padding: 28px; }
}
</style>
@endpush

@section('content')
<div class="page-banner">
    <h1>Contact Us</h1>
    <nav class="page-breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="sep">›</span>
        <span>Contact</span>
    </nav>
</div>

<div class="contact-page">
    <div class="contact-inner">
        <!-- Left: Info -->
        <div>
            <span class="section-label">Get In Touch</span>
            <h2 class="section-heading">We'd love to hear from you</h2>
            <div class="teal-divider"></div>
            <p style="font-size:15px;color:var(--muted);line-height:1.8;margin-bottom:0;">
                Whether you'd like information about our products, want to place a custom order, or simply want to say hello — drop by our bakery or reach out via phone, email or WhatsApp.
            </p>

            <div class="contact-details">
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div class="contact-item-label">Our Location</div>
                        <h4>Cake Atelier</h4>
                        <p>123 Baker's Lane, MG Road<br>Kochi, Kerala – 682001</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <div class="contact-item-label">Call Us</div>
                        <h4>Phone Numbers</h4>
                        <p>
                            <a href="tel:+914842767660">Tel: 0484 2767660</a><br>
                            <a href="tel:+919895588988">Mob: +91 98955 88988</a>
                        </p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <div class="contact-item-label">Email Us</div>
                        <h4>Email Address</h4>
                        <a href="mailto:hello@cakeatelier.in">hello@cakeatelier.in</a>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon"><i class="fa-brands fa-whatsapp"></i></div>
                    <div>
                        <div class="contact-item-label">WhatsApp Orders</div>
                        <h4>Chat with Us</h4>
                        <a href="https://wa.me/919895588988" target="_blank">+91 98955 88988</a>
                    </div>
                </div>
            </div>

            <div>
                <span class="section-label">Opening Hours</span>
                <table class="hours-table">
                    <tr><td>Monday – Friday</td><td>8:00 AM – 9:00 PM</td></tr>
                    <tr><td>Saturday</td><td>8:00 AM – 10:00 PM</td></tr>
                    <tr><td>Sunday</td><td>9:00 AM – 8:00 PM</td></tr>
                    <tr><td>Public Holidays</td><td>10:00 AM – 6:00 PM</td></tr>
                </table>
            </div>
        </div>

        <!-- Right: Form -->
        <div class="contact-form-wrap">
            <h3>Send Us a Message</h3>
            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            <form action="{{ route('contact.submit') }}" method="POST">
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
                <button type="submit" class="btn-teal" style="width:100%;justify-content:center;font-size:14px;padding:14px;">
                    <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Map -->
    <div class="map-wrap container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.376853434!2d76.2673!3d9.9312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTUnNTIuMyJOIDc2wrAxNic0Mi4zIkU!5e0!3m2!1sen!2sin!4v1600000000"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            title="Cake Atelier Location">
        </iframe>
    </div>
</div>
@endsection
