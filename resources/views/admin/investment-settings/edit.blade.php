@extends('layouts.app')

@section('title', 'Edit Investment')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="admin-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Admin only</span>
                <h1>Edit investment page</h1>
                <p>Update investment text and upload the image shown to visitors.</p>
            </div>
            <div class="admin-actions">
                <a href="{{ route('investment') }}" class="btn btn-outline-dark">
                    <i class="bi bi-eye-fill"></i>
                    View Investment
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

        <form class="admin-card investment-form-card" method="POST" action="{{ route('admin.investment.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="hero_title">Investment Heading</label>
                    <input class="form-control @error('hero_title') is-invalid @enderror" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}">
                    @error('hero_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="hero_text">Investment Description</label>
                    <textarea class="form-control @error('hero_text') is-invalid @enderror" id="hero_text" name="hero_text" rows="3">{{ old('hero_text', $settings['hero_text']) }}</textarea>
                    @error('hero_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="gallery_title">Gallery Heading</label>
                    <input class="form-control @error('gallery_title') is-invalid @enderror" id="gallery_title" name="gallery_title" value="{{ old('gallery_title', $settings['gallery_title']) }}">
                    @error('gallery_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="membership_title">Membership Heading</label>
                    <input class="form-control @error('membership_title') is-invalid @enderror" id="membership_title" name="membership_title" value="{{ old('membership_title', $settings['membership_title']) }}">
                    @error('membership_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="gallery_text">Gallery Text</label>
                    <textarea class="form-control @error('gallery_text') is-invalid @enderror" id="gallery_text" name="gallery_text" rows="3">{{ old('gallery_text', $settings['gallery_text']) }}</textarea>
                    @error('gallery_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="membership_text">Membership Text</label>
                    <textarea class="form-control @error('membership_text') is-invalid @enderror" id="membership_text" name="membership_text" rows="3">{{ old('membership_text', $settings['membership_text']) }}</textarea>
                    @error('membership_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="image">Upload Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" type="file" accept="image/*">
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                @if ($settings['image_path'])
                    <div class="col-12">
                        <label class="form-label">Current Image</label>
                        <div class="admin-image-preview" style="background-image:url('{{ asset('storage/'.$settings['image_path']) }}')"></div>
                        <button class="btn btn-outline-danger mt-3" type="submit" form="delete-investment-image-form">
                            <i class="bi bi-trash3-fill"></i>
                            Delete Image
                        </button>
                    </div>
                @endif
            </div>

            <button class="btn btn-primary btn-lg mt-4" type="submit">
                <i class="bi bi-save-fill"></i>
                Save Investment
            </button>
        </form>

        @if ($settings['image_path'])
            <form id="delete-investment-image-form" method="POST" action="{{ route('admin.investment.image.destroy') }}" onsubmit="return confirm('Delete this investment image?');">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </div>
</section>

@endsection
