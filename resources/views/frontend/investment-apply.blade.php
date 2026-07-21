@extends('layouts.app')

@section('title', 'Investment Application')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="investment-detail-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Investment form</span>
                <h1>Fill investment details</h1>
                <p>Select an investment slab from Rs. 10K to Rs. 1 Crore, then fill investor details.</p>
            </div>
            <a class="btn btn-outline-dark" href="{{ route('investment') }}">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
        </div>

        <form class="admin-card investment-form-card" method="POST" action="{{ route('investment.checkout') }}">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="name">Investor Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $investment['name'] ?? '') }}" placeholder="Enter full name" autofocus>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email', $investment['email'] ?? '') }}" placeholder="investor@example.com">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $investment['phone'] ?? '') }}" placeholder="+91 00000 00000">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="business_name">Investor / Company Name</label>
                    <input class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name" value="{{ old('business_name', $investment['business_name'] ?? '') }}" placeholder="Investor or company name">
                    @error('business_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="business_address">Address</label>
                    <input class="form-control @error('business_address') is-invalid @enderror" id="business_address" name="business_address" value="{{ old('business_address', $investment['business_address'] ?? '') }}" placeholder="Full address">
                    @error('business_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="city">City</label>
                    <input class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $investment['city'] ?? '') }}" placeholder="Your city">
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="state">State</label>
                    <input class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state', $investment['state'] ?? '') }}" placeholder="State">
                    @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="pincode">Pincode</label>
                    <input class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ old('pincode', $investment['pincode'] ?? '') }}" placeholder="000000">
                    @error('pincode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="category">Investment Focus</label>
                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                        <option value="">Select focus</option>
                        @foreach (['Short Term Growth', 'Long Term Growth', 'Business Expansion', 'Strategic Partnership', 'High Value Investment'] as $category)
                            <option value="{{ $category }}" @selected(old('category', $investment['category'] ?? '') === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                    @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Choose Investment Plan</label>
                    <div class="plan-select-grid">
                        @foreach ($plans as $key => $plan)
                            <label class="plan-radio-card">
                                <input type="radio" name="plan" value="{{ $key }}" @checked(old('plan', request('plan', $investment['plan'] ?? '')) === $key)>
                                <span>
                                    <small>{{ $plan['duration'] }}</small>
                                    <strong>{{ $plan['name'] }}</strong>
                                    <em>Rs. {{ number_format($plan['amount'], 0) }}</em>
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('plan') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="message">Extra Details</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="4" placeholder="Tell us your preferred amount range, timeline, or investment goal">{{ old('message', $investment['message'] ?? '') }}</textarea>
                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button class="btn btn-primary btn-lg mt-4" type="submit">
                <i class="bi bi-credit-card-fill"></i>
                Continue to Payment
            </button>
        </form>
    </div>
</section>

@endsection
