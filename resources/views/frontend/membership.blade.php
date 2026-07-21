@extends('layouts.app')

@section('title', 'Membership')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="content-section">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="section-kicker">Membership</span>
                <h1>{{ $settings['membership_title'] }}</h1>
                <p>{{ $settings['membership_text'] }}</p>
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('investment') }}">
                <i class="bi bi-person-badge"></i>
                View Plans
            </a>
        </div>
    </div>
</section>

@endsection
