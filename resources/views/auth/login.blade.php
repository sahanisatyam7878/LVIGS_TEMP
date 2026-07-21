@extends('layouts.app')

@section('title', 'User Login')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="admin-section login-section auth-section">

    <div class="container">

        <div class="login-card admin-card auth-card">

            <span class="section-kicker">
                Customer Access
            </span>

            <h1>Login to LVIGS MART</h1>

            <p>
                Login using your Email or Mobile Number.
            </p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">

                @csrf

                <!-- Email or Phone -->

                <div class="mb-3">

                    <label class="form-label">
                        Email or Mobile Number
                    </label>

                    <input
                        type="text"
                        name="login"
                        value="{{ old('login') }}"
                        class="form-control @error('login') is-invalid @enderror"
                        placeholder="Enter Email or Mobile Number"
                        autofocus>

                    @error('login')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Password -->

                <div class="mb-4">

                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter Password">

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-lg w-100">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Login

                </button>

            </form>

            <div class="auth-switch mt-3">

                Don't have an account?

                <a href="{{ route('register') }}">
                    Register Now
                </a>

            </div>

        </div>

    </div>

</section>

@endsection