@extends('layouts.app')

@section('title', 'Add Admin Note')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ filemtime(public_path('css/home.css')) }}">
@endpush

@section('content')

<section class="admin-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Add note</span>
                <h1>Add investment note</h1>
                <p>Add an internal note for the LVIGS MART investment setup.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">
                <i class="bi bi-images"></i>
                Admin Dashboard
            </a>
        </div>

        <form class="admin-card" method="POST" action="{{ route('admin.products.store') }}">
            @csrf

            <div class="row g-3">
                <input type="hidden" name="name" value="Investment Note">
                <input type="hidden" name="category" value="Investment">
                <input type="hidden" name="price" value="0">
                <input type="hidden" name="tag" value="Internal">

                <div class="col-12">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Write a short promotional description">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button class="btn btn-primary btn-lg mt-4" type="submit">
                <i class="bi bi-cloud-arrow-up-fill"></i>
                Save Note
            </button>
        </form>
    </div>
</section>

@endsection
