@extends('layouts.app')

@section('title', 'Investment Payment')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="content-section">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="section-kicker">Payment</span>
                <h1>Payment opens after investment details.</h1>
                <p>Select an investment plan first. After details are submitted, the payment step opens automatically.</p>
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('investment.apply') }}">
                <i class="bi bi-credit-card-2-front"></i>
                Continue to Payment
            </a>
        </div>
    </div>
</section>

@endsection
