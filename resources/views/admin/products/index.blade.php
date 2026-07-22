@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="admin-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Admin panel</span>
                <h1>Investment admin dashboard</h1>
                <p>Use this area for internal LVIGS MART investment updates.</p>
            </div>
            <div class="admin-actions">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    Add Note
                </a>
                <a href="{{ route('gallery') }}" class="btn btn-outline-dark">
                    <i class="bi bi-graph-up-arrow"></i>
                    Investment Page
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger" type="submit">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-card">
            <h2>Investor experience is active</h2>
            <p class="empty-text">Public visitors are now directed to investment plans and investor onboarding only.</p>
        </div>
    </div>
</section>

@endsection
