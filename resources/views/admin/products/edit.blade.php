@extends('layouts.app')

@section('title', 'Edit Admin Note')

@push('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="admin-section">
    <div class="container">
        <div class="admin-header">
            <div>
                <span class="section-kicker">Edit note</span>
                <h1>Update investment note</h1>
                <p>Change the internal investment note description.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i>
                Back to Admin Dashboard
            </a>
        </div>

        <form class="admin-card" method="POST" action="{{ route('admin.products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <input type="hidden" name="name" value="{{ old('name', $product->name ?: 'Investment Note') }}">
                <input type="hidden" name="category" value="{{ old('category', $product->category ?: 'Investment') }}">
                <input type="hidden" name="price" value="{{ old('price', $product->price ?: 0) }}">
                <input type="hidden" name="tag" value="{{ old('tag', $product->tag ?: 'Internal') }}">

                <div class="col-12">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Write a short promotional description">{{ old('description', $product->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <button class="btn btn-primary btn-lg mt-4" type="submit">
                <i class="bi bi-check-circle-fill"></i>
                Update Note
            </button>
        </form>
    </div>
</section>

@endsection
