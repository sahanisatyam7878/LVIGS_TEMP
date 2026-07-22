@extends('layouts.app')

@section('title', 'Investment Details')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="invest-landing-hero investment-page-hero">
    <div class="container">
        <div class="invest-landing-grid">
            <div class="invest-landing-copy">
                <span class="section-kicker">Investment opportunity</span>
                <h1>{{ $settings['hero_title'] }}</h1>
                <p class="hero-text">
                    {{ $settings['hero_text'] }}
                </p>

                <div class="hero-actions">
                    <a class="btn btn-primary btn-lg" href="#investment-plans">
                        <i class="bi bi-graph-up-arrow"></i>
                        View Investment Plans
                    </a>
                    <a class="btn btn-outline-dark btn-lg" href="{{ route('investment.apply') }}">
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
                <div class="invest-dashboard-main">
                    <span>Investment range</span>
                    <strong>Rs. 10K - 1CR</strong>
                    <small>Choose the slab that matches your growth goal.</small>
                </div>
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

<section class="investment-detail-section" id="investment-plans">
    <div class="container">
        <div class="section-heading">
            <span class="section-kicker">Choose your slab</span>
            <h2>Investment plans built for every growth stage.</h2>
        </div>

        <div class="investment-plan-grid">
            @foreach ($plans as $key => $plan)
                <article class="investment-plan-card">
                    @if ($key === '1cr')
                        <span class="plan-ribbon">Best value</span>
                    @endif
                    <span class="plan-kicker">{{ $plan['duration'] }}</span>
                    <h2>{{ $plan['name'] }}</h2>
                    <strong>Rs. {{ number_format($plan['amount'], 0) }}</strong>
                    <p>Choose this investment slab to start your LVIGS MART investor request with a clear payment and receipt flow.</p>
                    <ul class="investment-feature-list">
                        <li><i class="bi bi-check2-circle"></i> Investor onboarding</li>
                        <li><i class="bi bi-check2-circle"></i> Payment confirmation</li>
                        <li><i class="bi bi-check2-circle"></i> Digital receipt download</li>
                    </ul>
                    <a class="btn btn-outline-dark w-100" href="{{ route('investment.apply', ['plan' => $key]) }}">
                        Choose {{ $plan['duration'] }}
                    </a>
                </article>
            @endforeach
        </div>

        <div class="investment-detail-grid">
            <article class="investment-detail-card">
                <i class="bi bi-graph-up-arrow"></i>
                <h2>Investment selection</h2>
                <p>Choose a slab from Rs. 10K to Rs. 1 Crore and continue with your investor details.</p>
            </article>

            <article class="investment-detail-card">
                <i class="bi bi-credit-card-2-front-fill"></i>
                <h2>Payment workflow</h2>
                <p>Confirm your selected plan and record the payment method with an optional transaction reference.</p>
            </article>

            <article class="investment-detail-card">
                <i class="bi bi-headset"></i>
                <h2>Investor support</h2>
                <p>Contact the team before investing if you need help choosing the most suitable slab.</p>
            </article>
        </div>

        <div class="investment-contact-box">
            <div>
                <span class="section-kicker">Fast assistance</span>
                <h2>Want the team to confirm the best plan?</h2>
                <p>Send your preferred amount range and contact details. LVIGS MART will guide you to the right investment path.</p>
            </div>
            <div class="contact-actions">
                <a class="btn btn-dark btn-lg" href="tel:+910000000000">
                    <i class="bi bi-telephone-outbound-fill"></i>
                    +91 00000 00000
                </a>
                <a class="btn btn-outline-dark btn-lg" href="mailto:info@lvigsmart.com?subject=Investment%20Enquiry">
                    <i class="bi bi-send-fill"></i>
                    info@lvigsmart.com
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
