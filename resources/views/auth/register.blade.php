@extends('layouts.app')

@section('title', 'User Register')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="admin-section login-section auth-section">
    <div class="container">

        <div class="login-card admin-card auth-card">

            <span class="section-kicker">
                Create Account
            </span>

            <h1>Register for LVIGS MART</h1>

            <p>
                Create your account to continue.
            </p>

            <form method="POST" action="{{ route('register.submit') }}">

                @csrf

                <!-- Name -->

                <div class="mb-3">

                    <label class="form-label">Full Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Email -->

                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Phone -->

                <div class="mb-3">

                    <label class="form-label">
                        Mobile Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror">

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Password -->

                <div class="mb-3">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Confirm Password -->

                <div class="mb-4">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-lg w-100">

                    <i class="bi bi-person-plus-fill"></i>

                    Register Now

                </button>

            </form>

            <div class="auth-switch mt-3">

                Already have an account?

                <a href="{{ route('login') }}">
                    Login Here
                </a>

            </div>

        </div>

    </div>
</section>

@endsection