@extends('layouts.shop')

@section('title', 'Home - ShopZone')

@section('content')
<!-- Hero Section -->
<div class="bg-dark text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Welcome to ShopZone</h1>
                <p class="lead">Discover amazing products at unbeatable prices.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>Shop Now
                </a>
            </div>
            <div class="col-md-6 text-center">
                <i class="fas fa-store" style="font-size: 150px; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Shop by Category</h2>
    <div class="row">
        @forelse($categories as $category)
            <div class="col-md-3 mb-4">
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="text-decoration-none">
                    <div class="card text-center p-3">
                        <i class="fas fa-tag fa-2x text-primary mb-2"></i>
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="text-muted small">{{ $category->description }}</p>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center text-muted">No categories found.</p>
        @endforelse
    </div>
</div>

<!-- Featured Products -->
<div class="container my-5">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted small">{{ $product->category->name }}</p>
                        <p class="fw-bold text-primary">Rs. {{ number_format($product->price, 2) }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('product.show', $product->slug) }}"
                           class="btn btn-outline-primary btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No products found.</p>
        @endforelse
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('shop') }}" class="btn btn-primary">View All Products</a>
    </div>
</div>
@endsection