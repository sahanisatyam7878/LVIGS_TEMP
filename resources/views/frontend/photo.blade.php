@extends('layouts.app')

@section('title', 'Gallery')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="content-section">
    <div class="container">
        <div class="contact-box">
            <div>
                <span class="section-kicker">Gallery</span>
                <h1>Investment gallery is available.</h1>
                <p>Continue to the gallery to view the latest admin uploaded investment image.</p>
            </div>
            <a class="btn btn-primary btn-lg" href="{{ route('gallery') }}">
                <i class="bi bi-image"></i>
                Open Gallery
            </a>
        </div>
    </div>
</section>

@endsection
