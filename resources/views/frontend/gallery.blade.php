@extends('layouts.app')

@section('title', 'Investment')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="content-section">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="section-kicker">Gallery</span>
                <h1>{{ $settings['gallery_title'] }}</h1>
                <p>{{ $settings['gallery_text'] }}</p>
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('investment') }}">
                <i class="bi bi-graph-up-arrow"></i>
                View Plans
            </a>
        </div>

        @if ($settings['image_path'])
            <div class="investment-gallery-image" style="background-image:url('{{ asset('storage/'.$settings['image_path']) }}')"></div>
        @endif
    </div>
</section>

@endsection
