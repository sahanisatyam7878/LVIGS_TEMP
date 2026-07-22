@extends('layouts.app')

@section('title', 'Investment PDF Ready')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="investment-detail-section">
    <div class="container">
        <div class="investment-success-card">
            <div class="success-mark">
                <i class="bi bi-file-earmark-pdf-fill"></i>
            </div>
            <span class="section-kicker">Payment complete</span>
            <h1>Your investment PDF is ready</h1>
            <p>{{ $investment['name'] }}, your {{ $investment['plan_name'] }} investment payment is recorded. Download the PDF receipt from here.</p>

            <div class="receipt-list success-receipt">
                <span><strong>Application ID</strong>{{ $investment['application_id'] }}</span>
                <span><strong>Plan</strong>{{ $investment['plan_name'] }}</span>
                <span><strong>Duration</strong>{{ $investment['duration'] }}</span>
                <span><strong>Starts On</strong>{{ $investment['starts_on'] }}</span>
                <span><strong>Valid Until</strong>{{ $investment['valid_until'] }}</span>
                <span><strong>Amount</strong>Rs. {{ number_format($investment['amount'], 0) }}</span>
                <span><strong>Transaction</strong>{{ $investment['transaction_id'] }}</span>
                <span><strong>Status</strong>{{ $investment['status'] }}</span>
            </div>

            <div class="contact-actions justify-content-center">
                <a class="btn btn-primary btn-lg" href="{{ route('investment.receipt.pdf') }}">
                    <i class="bi bi-download"></i>
                    Download PDF
                </a>
                <a class="btn btn-outline-dark btn-lg" href="{{ route('investment') }}">
                    <i class="bi bi-arrow-left"></i>
                    Investment Page
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
