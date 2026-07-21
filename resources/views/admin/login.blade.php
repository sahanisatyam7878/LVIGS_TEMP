@extends('layouts.app')

@section('title', 'Admin Login')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="admin-section login-section">
    <div class="container">
        <div class="login-card admin-card">
            <span class="section-kicker">Admin only</span>
            <h1>Login to manage LVIGS MART</h1>
            <p>User login is not available. Only admin access is allowed.</p>

            <form method="POST" action="{{ route('admin.login.submit') }}" class="mt-4">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autofocus>
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary btn-lg w-100 justify-content-center" type="submit">
                    <i class="bi bi-shield-lock-fill"></i>
                    Admin Login
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
