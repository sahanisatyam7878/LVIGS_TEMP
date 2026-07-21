@extends('layouts.app')

@section('title', 'LVIGS MART')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="invest-landing-hero">
    <div class="container">
        <div class="invest-landing-grid">
            <div class="invest-landing-copy">
                <span class="section-kicker">Investment opportunity</span>
                <h1>{{ $settings['hero_title'] }}</h1>
                <p class="hero-text">
                    {{ $settings['hero_text'] }}
                </p>

                <div class="hero-actions">
                    <a href="{{ route('investment') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-graph-up-arrow"></i>
                        View Investment Plans
                    </a>
                    <a href="{{ route('investment.apply') }}" class="btn btn-outline-dark btn-lg">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                        Start Now
                    </a>
                </div>

                <div class="trust-row">
                    <div>
                        <strong>7</strong>
                        <span>Investment slabs</span>
                    </div>
                    <div>
                        <strong>10K</strong>
                        <span>Entry range</span>
                    </div>
                    <div>
                        <strong>1CR</strong>
                        <span>Top range</span>
                    </div>
                </div>
            </div>

            <div class="invest-dashboard" aria-label="LVIGS MART investment overview">
                <div class="investment-status-pill">
                    <i class="bi bi-shield-check"></i>
                    Secure investor flow
                </div>
                @if ($settings['image_path'])
                    <div class="investment-image-card" style="background-image:url('{{ asset('storage/'.$settings['image_path']) }}')"></div>
                @else
                    <div class="invest-dashboard-main">
                        <span>Investment range</span>
                        <strong>Rs. 10K - 1CR</strong>
                        <small>Choose the slab that matches your growth goal.</small>
                    </div>
                @endif
                <div class="invest-dashboard-list">
                    <span><i class="bi bi-ui-checks-grid"></i> Plan selection</span>
                    <span><i class="bi bi-person-vcard"></i> Investor details</span>
                    <span><i class="bi bi-credit-card-2-front"></i> Payment step</span>
                    <span><i class="bi bi-file-earmark-pdf"></i> PDF receipt</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-strip">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="bi bi-layers-fill"></i>
                    <div>
                        <strong>Clear slabs</strong>
                        <span>Pick from Rs. 10K to Rs. 1 Crore</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="bi bi-receipt-cutoff"></i>
                    <div>
                        <strong>Receipt ready</strong>
                        <span>Download payment proof instantly</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-item">
                    <i class="bi bi-headset"></i>
                    <div>
                        <strong>Team follow-up</strong>
                        <span>Get help choosing the right plan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="section-heading">
            <span class="section-kicker">Why invest</span>
            <h2>A simple, modern investment journey for interested partners.</h2>
        </div>

        <div class="category-grid">
            <article class="category-card">
                <i class="bi bi-graph-up-arrow"></i>
                <span class="category-badge">Growth</span>
                <h3>Growth participation</h3>
                <p>Join LVIGS MART through a transparent investment request and payment workflow.</p>
            </article>
            <article class="category-card">
                <i class="bi bi-wallet2"></i>
                <span class="category-badge">Range</span>
                <h3>Flexible amount</h3>
                <p>Start small or choose a higher slab based on your investment capacity.</p>
            </article>
            <article class="category-card">
                <i class="bi bi-file-earmark-check-fill"></i>
                <span class="category-badge">Proof</span>
                <h3>Digital record</h3>
                <p>Every completed payment produces a receipt with your plan and transaction details.</p>
            </article>
            <article class="category-card">
                <i class="bi bi-person-check-fill"></i>
                <span class="category-badge">Support</span>
                <h3>Guided process</h3>
                <p>The team can help you understand the best slab before you continue.</p>
            </article>
        </div>
    </div>
</section>

<section class="investment-section" id="investment">
    <div class="container">
        <div class="investment-panel">
            <div>
                <span class="section-kicker">Investor desk</span>
                <h2>Ready to choose an investment plan?</h2>
                <p>Review the slabs, fill the investor form, and complete payment to generate your receipt.</p>
            </div>
            <a class="btn btn-light btn-lg" href="{{ route('investment') }}">
                <i class="bi bi-graph-up-arrow"></i>
                Invest Now
            </a>
        </div>
    </div>
</section>

<section class="contact-section" id="contact">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="section-kicker">Investor enquiry</span>
                <h2>Talk to LVIGS MART before investing.</h2>
                <p>Share your preferred slab and contact details. The team will guide you through the next step.</p>
            </div>
            <div class="contact-actions">
                <a class="btn btn-dark btn-lg" href="tel:+910000000000">
                    <i class="bi bi-telephone-fill"></i>
                    Call Now
                </a>
                <a class="btn btn-outline-dark btn-lg" href="mailto:info@lvigsmart.com">
                    <i class="bi bi-envelope-fill"></i>
                    Email Us
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
