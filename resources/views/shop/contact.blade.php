@extends('layouts.app')

@section('title', 'Connect | L\'Atelier')
@section('meta_description', 'Connect with our master bakers and concierges. Schedule an appointment or inquire about our artisanal collections.')

@push('styles')
<style>
/* Page Header Override */
.page-header {
    background: url('https://images.unsplash.com/photo-1542826438-bd32f43d626f?q=80&w=2000&auto=format&fit=crop') center/cover;
}

.contact-page {
    max-width: 1400px;
    margin: -60px auto 100px;
    padding: 0 40px;
    position: relative;
    z-index: 10;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
}

.contact-info h2 {
    font-family: var(--font-script);
    font-size: clamp(50px, 8vw, 100px);
    line-height: 0.8; color: var(--color-accent);
    margin-bottom: 30px; font-weight: normal;
}
.contact-info p {
    font-family: var(--font-serif);
    font-size: 1.2rem; line-height: 1.8; color: var(--color-text-dim);
    margin-bottom: 50px;
}

.contact-details {
    display: flex; flex-direction: column; gap: 40px;
}
.contact-item {
    display: flex; gap: 20px; align-items: flex-start;
}
.contact-icon {
    font-size: 1.5rem; color: var(--color-accent); margin-top: 5px;
}
.contact-item h4 {
    font-family: var(--font-display);
    font-size: 0.8rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--color-text); margin-bottom: 10px;
}
.contact-item a, .contact-item div {
    font-family: var(--font-serif);
    font-size: 1.2rem; color: var(--color-text-dim);
    transition: color 0.3s; line-height: 1.5;
}
.contact-item a:hover { color: var(--color-accent); }

/* Form Styles */
.contact-form-container {
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

/* Map */
.map-wrap {
    margin-top: 80px;
    height: 400px;
    border: 1px solid rgba(255,255,255,0.05);
    filter: invert(100%) hue-rotate(180deg) brightness(80%) contrast(120%);
}
.map-wrap iframe { width: 100%; height: 100%; border: none; }


@media (max-width: 900px) {
    .contact-grid { grid-template-columns: 1fr; }
    .contact-form-container { padding: 30px 20px; }
}
@media (max-width: 600px) {
    .form-row { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<section class="page-header reveal">
    <div class="page-header-inner">
        <h1 class="section-title-cursive">Connect</h1>
        <div class="section-subtitle-serif">The Atelier Concierge</div>
    </div>
</section>

<div class="contact-page">
    <div class="contact-grid">
        
        <!-- Info -->
        <div class="contact-info reveal">
            <h2>Reach Out</h2>
            <p>We are dedicated to providing you with an unparalleled artisanal experience. Whether you wish to commission a custom creation or inquire about our collections, our concierge is at your service.</p>
            
            <div class="contact-details">
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot contact-icon"></i>
                    <div>
                        <h4>The Atelier</h4>
                        <div>123 Baker's Lane, MG Road<br>Kochi, UAE – 682001</div>
                    </div>
                </div>
                
                <div class="contact-item">
                    <i class="fa-solid fa-phone contact-icon"></i>
                    <div>
                        <h4>Direct Line</h4>
                        <a href="tel:+9714842767660">000000</a><br>
                        <a href="tel:+000000">000000</a>
                    </div>
                </div>

                <div class="contact-item">
                    <i class="fa-solid fa-envelope contact-icon"></i>
                    <div>
                        <h4>Electronic Mail</h4>
                        <a href="mailto:concierge@cakeatelier.in">concierge@cakeatelier.in</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="contact-form-container reveal" style="transition-delay: 0.2s">
            <h3 class="form-title">Send a Dispatch</h3>

            @if(session('success'))
                <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #4ade80; padding: 15px; margin-bottom: 20px; font-family: var(--font-serif);">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="name" required placeholder="E.g. James Smith">
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" required placeholder="client@address.ae">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="tel" name="phone" placeholder="+971">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <select name="subject" required>
                            <option value="">Select Topic</option>
                            <option>Collection Inquiry</option>
                            <option>Custom Cakes Commission</option>
                            <option>Delivery Logistics</option>
                            <option>Tasting Appointment</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="5" required placeholder="How may we assist you today?"></textarea>
                </div>
                <button type="submit" class="btn-solid" style="width:100%;">Dispatch Message</button>
            </form>
        </div>
        
    </div>

    <!-- Map -->
    <div class="map-wrap reveal">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.376853434!2d76.2673!3d9.9312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwNTUnNTIuMyJOIDc2wrAxNic0Mi4zIkU!5e0!3m2!1sen!2sin!4v1600000000"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>

@endsection
