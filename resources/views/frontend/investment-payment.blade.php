@extends('layouts.app')

@section('title', 'Investment Payment')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="investment-detail-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Payment</span>
                <h1>Confirm investment payment</h1>
                <p>Review the selected plan and complete payment to generate your PDF receipt.</p>
            </div>
            <a class="btn btn-outline-dark" href="{{ route('investment.apply') }}">
                <i class="bi bi-pencil-square"></i>
                Edit Details
            </a>
        </div>

        <div class="investment-checkout-grid">
            <div class="admin-card">
                <h2>Investor Details</h2>
                <div class="receipt-list">
                    <span><strong>Name</strong>{{ $investment['name'] }}</span>
                    <span><strong>Email</strong>{{ $investment['email'] }}</span>
                    <span><strong>Phone</strong>{{ $investment['phone'] }}</span>
                    <span><strong>Investor / Company</strong>{{ $investment['business_name'] }}</span>
                    <span><strong>Address</strong>{{ $investment['business_address'] }}</span>
                    <span><strong>City</strong>{{ $investment['city'] }}</span>
                    <span><strong>State</strong>{{ $investment['state'] }}</span>
                    <span><strong>Pincode</strong>{{ $investment['pincode'] }}</span>
                    <span><strong>Focus</strong>{{ $investment['category'] }}</span>
                </div>
            </div>

            <form class="admin-card payment-card" method="POST" action="{{ route('investment.payment.complete') }}">
                @csrf

                <span class="section-kicker">Selected plan</span>
                <h2>{{ $investment['plan_name'] }}</h2>
                <div class="payment-amount">Rs. {{ number_format($investment['amount'], 0) }}</div>
                <p>{{ $investment['duration'] }} investment access for LVIGS MART business promotion.</p>
                <div class="receipt-list mb-4">
                    <span><strong>Starts On</strong>{{ $investment['starts_on'] }}</span>
                    <span><strong>Valid Until</strong>{{ $investment['valid_until'] }}</span>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="payment_method">Payment Method</label>
                    <select class="form-select @error('payment_method') is-invalid @enderror" id="payment_method" name="payment_method">
                        @foreach (['UPI', 'Card', 'Net Banking'] as $method)
                            <option value="{{ $method }}" @selected(old('payment_method') === $method)>{{ $method }}</option>
                        @endforeach
                    </select>
                    @error('payment_method') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label" for="transaction_id">Transaction ID</label>
                    <input class="form-control @error('transaction_id') is-invalid @enderror" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" placeholder="Optional payment reference">
                    @error('transaction_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary btn-lg w-100 justify-content-center" type="submit">
                    <i class="bi bi-shield-check"></i>
                    Mark Payment Done
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
